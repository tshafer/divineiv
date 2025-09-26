<?php

namespace App\Console\Commands;

use App\Services\ExternalReviews\ReviewImporterService;
use Illuminate\Console\Command;

class ImportExternalReviews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reviews:import 
                            {--source=all : Which source to import from (all|google|yelp)}
                            {--force : Force import even if sync was recent}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import reviews from external sources (Google, Yelp)';

    public function __construct(
        private ReviewImporterService $reviewImporterService
    ) {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $source = $this->option('source');
        $force = $this->option('force');

        $this->info("Starting review import from: {$source}");

        try {
            switch (strtolower($source)) {
                case 'google':
                    $this->importGoogleOnly($force);
                    break;

                case 'yelp':
                    $this->importYelpOnly($force);
                    break;

                case 'all':
                default:
                    $this->importAllSources($force);
                    break;
            }

            $this->info('✅ Review import completed successfully');

            return Command::SUCCESS;

        } catch (\Exception $e) {
            $this->error('❌ Review import failed: '.$e->getMessage());

            return Command::FAILURE;
        }
    }

    /**
     * Import from Google only
     */
    private function importGoogleOnly(bool $force): void
    {
        $count = $this->reviewImporterService->importGoogleReviews();
        $this->info("✅ Successfully imported {$count} Google reviews");
    }

    /**
     * Import from Yelp only
     */
    private function importYelpOnly(bool $force): void
    {
        $count = $this->reviewImporterService->importYelpReviews();
        $this->info("✅ Successfully imported {$count} Yelp reviews");
    }

    /**
     * Import from all sources
     */
    private function importAllSources(bool $force): void
    {
        $results = $this->reviewImporterService->importAllReviews();

        $this->table(
            ['Source', 'Imported'],
            [
                ['Google Reviews', $results['google']],
                ['Yelp Reviews', $results['yelp']],
                ['Total', $results['total']],
            ]
        );

        if (! empty($results['errors'])) {
            $this->warn('⚠️ Some errors occurred:');
            foreach ($results['errors'] as $error) {
                $this->error("  - {$error}");
            }
        }
    }
}
