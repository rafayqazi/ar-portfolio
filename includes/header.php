<?php
// Determine current page for conditional styling and linking
$currentPage = basename($_SERVER['PHP_SELF']);
$isHome = ($currentPage === 'index.php');
$textColorClass = $isHome ? 'text-slate-300' : 'text-slate-900';
$logoColorClass = $isHome ? 'text-white' : 'text-slate-900';
$hoverColorClass = 'text-primary';
$navLinkPrefix = $isHome ? '' : 'index.php';
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['profile']['name']; ?> - Portfolio</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#3b82f6', // Sky 500
                        dark: '#0f172a',    // Slate 900
                        secondary: '#64748b' // Slate 500
                    }
                }
            }
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="<?php echo $isHome ? 'bg-dark' : 'bg-white'; ?> text-slate-300 font-sans antialiased">
    
    <!-- Navigation -->
    <nav x-data="{ open: false, scrolled: false }" 
         @scroll.window="scrolled = (window.pageYOffset > 20) ? true : false"
         :class="{ 'bg-dark/90 backdrop-blur-md shadow-lg': scrolled, '<?php echo $isHome ? 'bg-transparent' : 'bg-white/90 backdrop-blur-md border-b border-slate-200'; ?>': !scrolled }"
         class="fixed w-full top-0 z-50 transition-all duration-300">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="index.php" class="text-2xl font-bold text-primary tracking-tighter">
                AR<span class="<?php echo $logoColorClass; ?>">.</span>
            </a>
            
            <!-- Desktop Menu -->
            <div class="hidden md:flex space-x-8 text-sm font-medium <?php echo $textColorClass; ?>">
                <a href="<?php echo $navLinkPrefix; ?>#about" class="hover:text-primary transition-colors">About</a>
                <a href="<?php echo $navLinkPrefix; ?>#skills" class="hover:text-primary transition-colors">Skills</a>
                <a href="<?php echo $navLinkPrefix; ?>#portfolio" class="hover:text-primary transition-colors">Portfolio</a>
                <a href="<?php echo $navLinkPrefix; ?>#experience" class="hover:text-primary transition-colors">Experience</a>
                <a href="<?php echo $navLinkPrefix; ?>#contact" class="px-4 py-2 border border-primary text-primary rounded-full hover:bg-primary hover:text-white transition-all">Contact Me</a>
            </div>

            <!-- Mobile Menu Button -->
            <button @click="open = !open" class="md:hidden focus:outline-none <?php echo $textColorClass; ?>">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>

        <!-- Mobile Menu Dropdown -->
        <div x-show="open" 
             @click.away="open = false"
             class="md:hidden bg-dark border-t border-slate-800 absolute w-full left-0">
            <div class="flex flex-col p-4 space-y-4 text-center text-slate-300">
                <a href="<?php echo $navLinkPrefix; ?>#about" @click="open = false" class="block hover:text-primary">About</a>
                <a href="<?php echo $navLinkPrefix; ?>#skills" @click="open = false" class="block hover:text-primary">Skills</a>
                <a href="<?php echo $navLinkPrefix; ?>#portfolio" @click="open = false" class="block hover:text-primary">Portfolio</a>
                <a href="<?php echo $navLinkPrefix; ?>#contact" @click="open = false" class="block text-primary">Contact Me</a>
            </div>
        </div>
    </nav>
