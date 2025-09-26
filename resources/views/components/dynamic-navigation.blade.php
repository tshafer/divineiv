@props([
    'name' => 'main-menu',
    'level' => 0,
    'maxLevel' => 2
])

@php
    // Get menus from the database
    $menus = \App\Models\Menu::published()
        ->parentItems()
        ->ordered()
        ->when($level > 0, function($query) use ($level) {
            // For submenus, we'll need to pass parent_id as a prop or handle differently
            return $query->where('level', $level);
        })
        ->get();
@endphp

@if($menus->count() > 0)
    <div
        class="{{ $attributes->get('class') }}"
        {{ $attributes->except('class') }}
    >
        @foreach($menus as $menu)
            @php
                $hasChildren = $menu->children()->count() > 0;
                $baseLinkClasses = $attributes->get('linkClass', 'text-white hover:text-cyan-300 font-medium transition-colors duration-300 relative group');

                // Check if this menu item is active
                $isActive = \App\Helpers\MenuHelper::isMenuItemActive($menu);
                $activeClasses = $isActive ? ' text-cyan-300' : '';
                $linkClasses = $baseLinkClasses . $activeClasses;

                // Add custom CSS classes if specified in database
                if($menu->css_classes) {
                    $linkClasses .= ' ' . $menu->css_classes;
                }
            @endphp

            @if($hasChildren)
                <!-- Menu item with children -->
                <div class="relative group">
                    <a href="{{ $menu->full_url }}"
                       class="{{ $linkClasses }}"
                       target="{{ $menu->target ?? '_self' }}"
                       {{ $menu->isTranslated() ? 'data-translate' : '' }}
                       {{ $menu->isRewards() ? 'data-rewards' : '' }}
                    >
                        @if($menu->icon)
                            <i class="{{ $menu->icon }} mr-2"></i>
                        @endif
                        {{ $menu->title }}
                        @if($hasChildren)
                            <i class="fas fa-chevron-down ml-1 text-xs transform group-hover:rotate-180 transition-transform"></i>
                        @endif
                        <span class="absolute bottom-0 left-0 {{ $isActive ? 'w-full' : 'w-0' }} h-0.5 bg-cyan-300 transition-all duration-300 group-hover:w-full"></span>
                    </a>

                    @if($hasChildren && $level < $maxLevel)
                        <!-- Dropdown submenu -->
                        <div class="absolute left-0 mt-2 w-56 bg-white rounded-md shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50 transform -translate-y-2 group-hover:translate-y-0">
                            <div class="py-2">
                                @foreach($menu->children as $child)
                                    @php
                                        $childIsActive = \App\Helpers\MenuHelper::isMenuItemActive($child);
                                    @endphp
                                    <a href="{{ $child->full_url }}"
                                       class="block px-4 py-2 {{ $childIsActive ? 'bg-blue-100 text-blue-800 font-medium' : 'text-gray-800' }} hover:bg-blue-50 hover:text-blue-600 transition-colors duration-300"
                                       target="{{ $child->target ?? '_self' }}"
                                    >
                                        @if($child->icon)
                                            <i class="{{ $child->icon }} mr-2 text-sm"></i>
                                        @endif
                                        {{ $child->title }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            @else
                <!-- Simple menu item -->
                <a href="{{ $menu->full_url }}"
                   class="{{ $linkClasses }}"
                   target="{{ $menu->target ?? '_self' }}"
                   {{ $menu->isTranslated() ? 'data-translate' : '' }}
                   {{ $menu->isRewards() ? 'data-rewards' : '' }}
                >
                    @if($menu->icon)
                        <i class="{{ $menu->icon }} mr-2"></i>
                    @endif
                    {{ $menu->title }}
                    <span class="absolute bottom-0 left-0 {{ $isActive ? 'w-full' : 'w-0' }} h-0.5 bg-cyan-300 transition-all duration-300 group-hover:w-full"></span>
                </a>
            @endif
        @endforeach
    </div>
@endif

@if($menus->count() == 0 && $level == 0)
    <!-- Fallback to hardcoded menu if nothing exists in database -->
    <div class="hidden lg:flex items-center space-x-8">
        <a href="{{ route('home') }}" class="text-white hover:text-cyan-300 font-medium transition-colors duration-300 relative group">
            Home
            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-cyan-300 transition-all duration-300 group-hover:w-full"></span>
        </a>
        <a href="{{ route('page', 'about-us') }}" class="text-white hover:text-cyan-300 font-medium transition-colors duration-300 relative group">
            About
            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-cyan-300 transition-all duration-300 group-hover:w-full"></span>
        </a>
        <a href="{{ route('services') }}" class="text-white hover:text-cyan-300 font-medium transition-colors duration-300 relative group">
            Services
            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-cyan-300 transition-all duration-300 group-hover:w-full"></span>
        </a>
        <a href="{{ route('contact') }}" class="text-white hover:text-cyan-300 font-medium transition-colors duration-300 relative group">
            Contact
            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-cyan-300 transition-all duration-300 group-hover:w-full"></span>
        </a>
    </div>
@endif
