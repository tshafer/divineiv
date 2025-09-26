<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Page;
use App\Models\Service;
use App\Models\Review;
use App\Models\Gallery;
use DOMDocument;
use DOMXPath;
use Illuminate\Support\Str;

class ImportHtmlContent extends Command
{
    protected $signature = 'import:html-content {--path=divineiv.com}';
    protected $description = 'Import HTML content from divineiv.com directory into Laravel models';

    public function handle()
    {
        try {
            $path = $this->option('path');
            $fullPath = base_path($path);

            if (!is_dir($fullPath)) {
                $this->error("Directory {$fullPath} does not exist!");
                return 1;
            }

            $this->info("Starting HTML content import from {$fullPath}...");

        // Import different types of content
        $this->importPages($fullPath);
        $this->importBlogPosts($fullPath);
        $this->importServices($fullPath);
        $this->importReviews($fullPath);
        $this->importGalleries($fullPath);
        
        // Import any remaining HTML files
        $this->importRemainingFiles($fullPath);

            $this->info("HTML content import completed!");
            return 0;
        } catch (\Exception $e) {
            $this->error("Error during import: " . $e->getMessage());
            $this->error("File: " . $e->getFile() . " Line: " . $e->getLine());
            $this->error("Stack trace: " . $e->getTraceAsString());
            return 1;
        }
    }

    private function importPages($basePath)
    {
        $this->info("Importing static pages...");

        $pageFiles = [
            'index.html' => 'Home',
            'about-us.html' => 'About Us',
            'contact-us.html' => 'Contact Us',
            'our-team.html' => 'Our Team',
            'divine-iv-and-wellness.html' => 'Our Office',
            'technology.html' => 'Technology',
            'harmony-xl-pro.html' => 'Harmony XL PRO',
            'opus.html' => 'OPUS',
            'ted.html' => 'TED',
            'financing-information.html' => 'Financing Information',
            'iv-faq.html' => 'IV FAQ',
            'skincare.html' => 'Skincare',
            'vip-rewards.html' => 'VIP Rewards',
            'patient-resources.html' => 'Patient Resources',
            'privacy-policy.html' => 'Privacy Policy',
            'sitemap.html' => 'Sitemap',
            'leave-a-review.html' => 'Leave a Review',
            // 'reviews.html' => 'Reviews', // Skip for now - very large file
            'galleries.html' => 'Galleries',
            'services.html' => 'Services',
            'med-spa-blog.html' => 'Med Spa Blog',
            'amy-berkhout.html' => 'Amy Berkhout',
        ];

        foreach ($pageFiles as $file => $title) {
            $filePath = $basePath . '/' . $file;
            if (file_exists($filePath)) {
                $this->importPage($filePath, $title, $file);
            }
        }
    }

    private function importBlogPosts($basePath)
    {
        $this->info("Importing blog posts...");

        $blogPath = $basePath . '/med-spa-blog';
        if (!is_dir($blogPath)) {
            $this->warn("Blog directory not found: {$blogPath}");
            return;
        }

        $files = glob($blogPath . '/*.html');
        $this->info("Found " . count($files) . " blog files");
        
        foreach ($files as $file) {
            $filename = basename($file);
            $this->info("Processing blog file: {$filename}");
            if ($filename !== 'med-spa-blog.html' && $filename !== 'rss.xml') {
                $this->importBlogPost($file);
            }
        }
    }

    private function importServices($basePath)
    {
        $this->info("Importing services...");

        $servicesPath = $basePath . '/services';
        if (!is_dir($servicesPath)) {
            $this->warn("Services directory not found: {$servicesPath}");
            return;
        }

        $this->importServicesRecursively($servicesPath);
    }

    private function importServicesRecursively($path, $category = null)
    {
        $files = glob($path . '/*.html');
        foreach ($files as $file) {
            $filename = basename($file);
            if ($filename !== 'services.html') {
                $this->importService($file, $category);
            }
        }

        // Process subdirectories
        $dirs = glob($path . '/*', GLOB_ONLYDIR);
        foreach ($dirs as $dir) {
            $categoryName = basename($dir);
            $this->importServicesRecursively($dir, $categoryName);
        }
    }

    private function importReviews($basePath)
    {
        $this->info("Importing reviews...");

        // Extract reviews from the homepage testimonials
        $homepagePath = $basePath . '/index.html';
        if (file_exists($homepagePath)) {
            $this->importReviewsFromHomepage($homepagePath);
        }
    }

    private function importGalleries($basePath)
    {
        $this->info("Importing galleries...");

        $galleriesPath = $basePath . '/galleries';
        if (!is_dir($galleriesPath)) {
            $this->warn("Galleries directory not found: {$galleriesPath}");
            return;
        }

        $this->importGalleriesRecursively($galleriesPath);
    }

    private function importGalleriesRecursively($path, $category = null)
    {
        $files = glob($path . '/*.html');
        foreach ($files as $file) {
            $filename = basename($file);
            if ($filename !== 'galleries.html') {
                $this->importGallery($file, $category);
            }
        }

        // Process subdirectories
        $dirs = glob($path . '/*', GLOB_ONLYDIR);
        foreach ($dirs as $dir) {
            $categoryName = basename($dir);
            $this->importGalleriesRecursively($dir, $categoryName);
        }
    }

    private function importRemainingFiles($basePath)
    {
        $this->info("Importing any remaining HTML files...");
        
        // Find all HTML files recursively
        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($basePath)
        );
        
        $htmlFiles = new \RegexIterator($iterator, '/\.html$/i');
        
        foreach ($htmlFiles as $file) {
            $filePath = $file->getPathname();
            $filename = basename($filePath);
            
            // Skip if already processed or if it's a directory
            if (is_dir($filePath)) {
                continue;
            }
            
            $this->info("Found remaining file: {$filename}");
            
            try {
                $html = file_get_contents($filePath);
                $data = $this->extractPageData($html, $filename, $filename);
                
                $slug = $this->generateSlug($filename);
                
                Page::updateOrCreate(
                    ['slug' => $slug],
                    array_merge($data, ['type' => 'page'])
                );
                
                $this->line("Imported remaining file: {$filename}");
                
                // Delete the HTML file after successful import
                if (unlink($filePath)) {
                    $this->line("Deleted: {$filename}");
                } else {
                    $this->warn("Could not delete: {$filename}");
                }
            } catch (\Exception $e) {
                $this->error("Error importing remaining file {$filename}: " . $e->getMessage());
            }
        }
    }

    private function importPage($filePath, $title, $filename)
    {
        try {
            $html = file_get_contents($filePath);
            $data = $this->extractPageData($html, $title, $filename);
            
            $slug = $this->generateSlug($filename);
            
            Page::updateOrCreate(
                ['slug' => $slug],
                $data
            );
            
            $this->line("Imported page: {$title}");
            
            // Delete the HTML file after successful import
            if (unlink($filePath)) {
                $this->line("Deleted: {$filename}");
            } else {
                $this->warn("Could not delete: {$filename}");
            }
        } catch (\Exception $e) {
            $this->error("Error importing page {$title}: " . $e->getMessage());
        }
    }

    private function importBlogPost($filePath)
    {
        try {
            $this->info("Reading file: {$filePath}");
            $html = file_get_contents($filePath);
            $this->info("File read, size: " . strlen($html) . " bytes");
            
            $this->info("Extracting blog post data...");
            $data = $this->extractBlogPostData($html, $filePath);
            $this->info("Data extracted, title: " . ($data['title'] ?? 'No title'));
            
            $slug = $this->generateSlug(basename($filePath));
            $this->info("Generated slug: {$slug}");
            
            $this->info("Saving to database...");
            Page::updateOrCreate(
                ['slug' => $slug],
                array_merge($data, ['type' => 'blog_post'])
            );
            
            $this->line("Imported blog post: {$data['title']}");
            
            // Delete the HTML file after successful import
            if (unlink($filePath)) {
                $this->line("Deleted: " . basename($filePath));
            } else {
                $this->warn("Could not delete: " . basename($filePath));
            }
        } catch (\Exception $e) {
            $this->error("Error importing blog post {$filePath}: " . $e->getMessage());
            $this->error("Stack trace: " . $e->getTraceAsString());
        }
    }

    private function importService($filePath, $category = null)
    {
        try {
            $html = file_get_contents($filePath);
            $data = $this->extractServiceData($html, $filePath, $category);
            
            $slug = $this->generateSlug(basename($filePath));
            
            Service::updateOrCreate(
                ['slug' => $slug],
                $data
            );
            
            $this->line("Imported service: {$data['title']}");
            
            // Delete the HTML file after successful import
            if (unlink($filePath)) {
                $this->line("Deleted: " . basename($filePath));
            } else {
                $this->warn("Could not delete: " . basename($filePath));
            }
        } catch (\Exception $e) {
            $this->error("Error importing service {$filePath}: " . $e->getMessage());
        }
    }

    private function importReviewsFromHomepage($filePath)
    {
        try {
            $html = file_get_contents($filePath);
            $reviews = $this->extractReviewsFromHomepage($html);

            foreach ($reviews as $reviewData) {
                Review::updateOrCreate(
                    ['content' => $reviewData['content']],
                    $reviewData
                );
            }

            $this->line("Imported " . count($reviews) . " reviews from homepage");
        } catch (\Exception $e) {
            $this->error("Error importing reviews from homepage: " . $e->getMessage());
        }
    }

    private function importGallery($filePath, $category = null)
    {
        try {
            $html = file_get_contents($filePath);
            $data = $this->extractGalleryData($html, $filePath, $category);
            
            $slug = $this->generateSlug(basename($filePath));
            
            Gallery::updateOrCreate(
                ['slug' => $slug],
                $data
            );
            
            $this->line("Imported gallery: {$data['title']}");
            
            // Delete the HTML file after successful import
            if (unlink($filePath)) {
                $this->line("Deleted: " . basename($filePath));
            } else {
                $this->warn("Could not delete: " . basename($filePath));
            }
        } catch (\Exception $e) {
            $this->error("Error importing gallery {$filePath}: " . $e->getMessage());
        }
    }

    private function extractPageData($html, $title, $filename)
    {
        $dom = new DOMDocument();
        @$dom->loadHTML($html);
        $xpath = new DOMXPath($dom);

        // Extract meta description
        $metaDescription = '';
        $metaNodes = $xpath->query('//meta[@name="description"]');
        if ($metaNodes->length > 0) {
            $metaDescription = $metaNodes->item(0)->getAttribute('content');
        }

        // Extract main content
        $content = $this->extractMainContent($xpath);

        return [
            'title' => $title,
            'content' => $content,
            'excerpt' => $this->generateExcerpt($content),
            'meta_title' => $title,
            'meta_description' => $metaDescription,
            'featured_image' => $this->extractFeaturedImage($xpath),
            'active' => true,
        ];
    }

    private function extractBlogPostData($html, $filePath)
    {
        $dom = new DOMDocument();
        @$dom->loadHTML($html);
        $xpath = new DOMXPath($dom);

        // Extract title from h1 or title tag
        $title = '';
        $titleNodes = $xpath->query('//h1');
        if ($titleNodes->length > 0) {
            $title = trim($titleNodes->item(0)->textContent);
        } else {
            $titleNodes = $xpath->query('//title');
            if ($titleNodes->length > 0) {
                $title = trim($titleNodes->item(0)->textContent);
            }
        }

        // Extract meta description
        $metaDescription = '';
        $metaNodes = $xpath->query('//meta[@name="description"]');
        if ($metaNodes->length > 0) {
            $metaDescription = $metaNodes->item(0)->getAttribute('content');
        }

        // Extract main content
        $content = $this->extractMainContent($xpath);

        return [
            'title' => $title,
            'content' => $content,
            'excerpt' => $this->generateExcerpt($content),
            'meta_title' => $title,
            'meta_description' => $metaDescription,
            'featured_image' => $this->extractFeaturedImage($xpath),
            'active' => true,
        ];
    }

    private function extractServiceData($html, $filePath, $category)
    {
        $dom = new DOMDocument();
        @$dom->loadHTML($html);
        $xpath = new DOMXPath($dom);

        // Extract title from h1 or title tag
        $title = '';
        $titleNodes = $xpath->query('//h1');
        if ($titleNodes->length > 0) {
            $title = trim($titleNodes->item(0)->textContent);
        } else {
            $titleNodes = $xpath->query('//title');
            if ($titleNodes->length > 0) {
                $title = trim($titleNodes->item(0)->textContent);
            }
        }

        // Extract meta description
        $metaDescription = '';
        $metaNodes = $xpath->query('//meta[@name="description"]');
        if ($metaNodes->length > 0) {
            $metaDescription = $metaNodes->item(0)->getAttribute('content');
        }

        // Extract main content
        $content = $this->extractMainContent($xpath);

        return [
            'title' => $title,
            'description' => $metaDescription,
            'content' => $content,
            'image' => $this->extractFeaturedImage($xpath),
            'category' => $category,
            'featured' => false,
            'sort_order' => 0,
            'active' => true,
        ];
    }

    private function extractReviewsFromHomepage($html)
    {
        $dom = new DOMDocument();
        @$dom->loadHTML($html);
        $xpath = new DOMXPath($dom);

        $reviews = [];
        $reviewNodes = $xpath->query('//div[contains(@class, "testimonials-rotator__item")]');

        foreach ($reviewNodes as $reviewNode) {
            $textNode = $xpath->query('.//p[contains(@class, "testimonials-rotator__item-text")]', $reviewNode);
            $authorNode = $xpath->query('.//p[contains(@class, "testimonials-rotator__item-author")]', $reviewNode);

            if ($textNode->length > 0 && $authorNode->length > 0) {
                $content = trim($textNode->item(0)->textContent);
                $authorText = trim($authorNode->item(0)->textContent);

                // Parse author and source
                $authorParts = explode(' ', $authorText);
                $authorName = $authorParts[0] ?? 'Anonymous';
                $source = end($authorParts) ?? 'Google';

                $reviews[] = [
                    'author_name' => $authorName,
                    'content' => $content,
                    'rating' => 5, // Default to 5 stars based on the site
                    'source' => $source,
                    'source_url' => null,
                    'featured' => true,
                    'active' => true,
                ];
            }
        }

        return $reviews;
    }

    private function extractGalleryData($html, $filePath, $category)
    {
        $dom = new DOMDocument();
        @$dom->loadHTML($html);
        $xpath = new DOMXPath($dom);

        // Extract title from h1 or title tag
        $title = '';
        $titleNodes = $xpath->query('//h1');
        if ($titleNodes->length > 0) {
            $title = trim($titleNodes->item(0)->textContent);
        } else {
            $titleNodes = $xpath->query('//title');
            if ($titleNodes->length > 0) {
                $title = trim($titleNodes->item(0)->textContent);
            }
        }

        // Extract images
        $images = [];
        $imageNodes = $xpath->query('//img');
        foreach ($imageNodes as $imgNode) {
            $src = $imgNode->getAttribute('src');
            if ($src && !str_contains($src, 'data:')) {
                $images[] = $src;
            }
        }

        return [
            'title' => $title,
            'description' => $this->extractMainContent($xpath),
            'image_url' => !empty($images) ? $images[0] : null,
            'thumbnail_url' => !empty($images) ? $images[0] : null,
            'alt_text' => $title,
            'sort_order' => 0,
            'featured' => false,
            'active' => true,
        ];
    }

    private function extractMainContent($xpath)
    {
        // Try to find main content in various containers
        $contentSelectors = [
            '//main',
            '//div[contains(@class, "section")]',
            '//div[contains(@class, "content")]',
            '//article',
            '//div[contains(@class, "text")]',
        ];

        foreach ($contentSelectors as $selector) {
            try {
                $nodes = $xpath->query($selector);
                if ($nodes->length > 0) {
                    $content = '';
                    $count = 0;
                    foreach ($nodes as $node) {
                        $count++;
                        if ($count > 50) { // Limit to prevent infinite loops
                            break;
                        }
                        $content .= $this->getInnerHtml($node) . "\n";
                    }
                    if (trim($content)) {
                        return $this->cleanHtml($content);
                    }
                }
            } catch (\Exception $e) {
                // Skip this selector if it causes issues
                continue;
            }
        }

        return '';
    }

    private function extractFeaturedImage($xpath)
    {
        // Try to find featured image
        $imageSelectors = [
            '//meta[@property="og:image"]/@content',
            '//img[contains(@class, "featured")]/@src',
            '//img[contains(@class, "hero")]/@src',
            '//img[1]/@src',
        ];

        foreach ($imageSelectors as $selector) {
            $nodes = $xpath->query($selector);
            if ($nodes->length > 0) {
                $src = $nodes->item(0)->textContent;
                if ($src && !str_contains($src, 'data:')) {
                    return $src;
                }
            }
        }

        return null;
    }

    private function getInnerHtml($node)
    {
        $innerHTML = '';
        $children = $node->childNodes;
        foreach ($children as $child) {
            $innerHTML .= $node->ownerDocument->saveHTML($child);
        }
        return $innerHTML;
    }

    private function cleanHtml($html)
    {
        // Remove script and style tags
        $html = preg_replace('/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/mi', '', $html);
        $html = preg_replace('/<style\b[^<]*(?:(?!<\/style>)<[^<]*)*<\/style>/mi', '', $html);

        // Clean up whitespace
        $html = preg_replace('/\s+/', ' ', $html);
        $html = trim($html);

        return $html;
    }

    private function generateExcerpt($content, $length = 160)
    {
        $text = strip_tags($content);
        if (strlen($text) <= $length) {
            return $text;
        }
        return substr($text, 0, $length) . '...';
    }

    private function generateSlug($filename)
    {
        $slug = str_replace('.html', '', $filename);
        $slug = str_replace('-', ' ', $slug);
        $slug = Str::slug($slug);
        return $slug;
    }
}
