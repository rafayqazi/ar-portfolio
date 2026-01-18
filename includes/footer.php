    <footer class="bg-slate-900 border-t border-slate-800 py-12 mt-20 relative z-10">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-2xl font-bold text-white mb-6">Let's Work Together</h2>
            <div class="flex justify-center space-x-6 mb-8">
                <?php foreach($data['profile']['socials'] as $platform => $link): ?>
                    <a href="<?php echo $link; ?>" target="_blank" class="text-slate-400 hover:text-primary capitalize transition-colors">
                        <?php echo $platform; ?>
                    </a>
                <?php endforeach; ?>
            </div>
            <p class="text-slate-500 text-sm">
                &copy; <?php echo date('Y'); ?> <?php echo $data['profile']['name']; ?>. All rights reserved.
            </p>
        </div>
    </footer>

    <!-- Custom Cursor Elements -->
    <div id="cursor-dot" class="fixed w-2 h-2 bg-primary rounded-full pointer-events-none z-[9999] transform -translate-x-1/2 -translate-y-1/2 transition-transform duration-100 hidden md:block mix-blend-difference"></div>
    <div id="cursor-outline" class="fixed w-8 h-8 border border-primary rounded-full pointer-events-none z-[9999] transform -translate-x-1/2 -translate-y-1/2 transition-all duration-300 hidden md:block mix-blend-difference"></div>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const cursorDot = document.getElementById('cursor-dot');
        const cursorOutline = document.getElementById('cursor-outline');
        
        // Only activate on desktop
        if (window.matchMedia("(min-width: 768px)").matches) {
            window.addEventListener('mousemove', (e) => {
                const posX = e.clientX;
                const posY = e.clientY;
                
                // Dot follows exactly
                cursorDot.style.left = `${posX}px`;
                cursorDot.style.top = `${posY}px`;
                
                // Outline follows with slight delay (handled by CSS transition), simple position update
                cursorOutline.style.left = `${posX}px`;
                cursorOutline.style.top = `${posY}px`;
            });

            // Add special effects for links and interactive elements
            const interactiveElements = document.querySelectorAll('a, button, input, textarea, .group, .cursor-none-target');
            
            interactiveElements.forEach(el => {
                el.addEventListener('mouseenter', () => {
                    cursorOutline.classList.add('scale-150', 'bg-primary/20', 'border-transparent');
                    cursorDot.classList.add('scale-50');
                });
                
                el.addEventListener('mouseleave', () => {
                    cursorOutline.classList.remove('scale-150', 'bg-primary/20', 'border-transparent');
                    cursorDot.classList.remove('scale-50');
                });
            });

            // Hide default cursor
            document.body.style.cursor = 'none';
        }
    });
    </script>

    <!-- Script for simple scroll reveal if needed later -->
</body>
</html>
