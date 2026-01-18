<?php
require_once 'data.php';

// Get project ID from URL
$projectId = $_GET['id'] ?? null;
$project = null;

// Find the project in the data array
if ($projectId) {
    foreach ($data['portfolio'] as $category => $items) {
        foreach ($items as $item) {
            if ($item['id'] === $projectId) {
                $project = $item;
                $project['category'] = $category;
                break 2;
            }
        }
    }
}

// Redirect to home if project not found
if (!$project) {
    header('Location: index.php');
    exit;
}

require_once 'includes/header.php';
?>

<div class="bg-white text-slate-800 min-h-screen pt-24 pb-12" x-data="{ 
    images: <?php echo htmlspecialchars(json_encode($project['images'])); ?>,
    activeImage: '<?php echo !empty($project['images']) ? $project['images'][0] : ''; ?>',
    activeIndex: 0,
    autoplayInterval: null,
    
    init() {
        if (this.images.length > 1) {
            this.startAutoplay();
            this.$watch('activeIndex', value => this.activeImage = this.images[value]);
        }
    },
    startAutoplay() {
        this.stopAutoplay();
        this.autoplayInterval = setInterval(() => {
            this.next();
        }, 3000);
    },
    stopAutoplay() {
        if (this.autoplayInterval) {
            clearInterval(this.autoplayInterval);
            this.autoplayInterval = null;
        }
    },
    next() {
        this.activeIndex = (this.activeIndex + 1) % this.images.length;
    },
    prev() {
        this.activeIndex = (this.activeIndex - 1 + this.images.length) % this.images.length;
    },
    setImage(index) {
        this.activeIndex = index;
        this.stopAutoplay();
        this.startAutoplay();
    }
 }"
 x-init="init()">
    <div class="container mx-auto px-4 lg:px-6 max-w-5xl">
        
        <!-- Breadcrumb -->
        <nav class="flex mb-6 text-sm text-slate-500">
            <a href="index.php" class="hover:text-primary transition-colors">Home</a>
            <span class="mx-2">/</span>
            <a href="index.php#portfolio" class="hover:text-primary transition-colors">Portfolio</a>
            <span class="mx-2">/</span>
            <span class="text-slate-800 font-medium"><?php echo htmlspecialchars($project['category']); ?></span>
        </nav>

        <!-- Carousel Section (Top) -->
        <div class="mb-12">
            <!-- Main Active Image -->
            <div class="w-full h-[400px] md:h-[600px] bg-slate-100 rounded-2xl overflow-hidden mb-4 border border-slate-200 flex items-center justify-center relative group shadow-lg"
                    @mouseenter="stopAutoplay()" 
                    @mouseleave="startAutoplay()">
                    
                    <?php if (!empty($project['images'])): ?>
                    <img :src="activeImage" alt="<?php echo $project['title']; ?>" class="w-full h-full object-contain" x-transition.opacity.duration.500ms>
                    
                    <!-- Navigation Buttons -->
                    <?php if (count($project['images']) > 1): ?>
                        <button @click="prev()" class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/10 backdrop-blur-md text-slate-800 p-3 rounded-full hover:bg-white/30 transition-all opacity-0 group-hover:opacity-100 focus:opacity-100 border border-white/20 shadow-xl">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                        </button>
                        <button @click="next()" class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/10 backdrop-blur-md text-slate-800 p-3 rounded-full hover:bg-white/30 transition-all opacity-0 group-hover:opacity-100 focus:opacity-100 border border-white/20 shadow-xl">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </button>
                    <?php endif; ?>

                <?php else: ?>
                    <span class="text-6xl text-slate-300 font-bold"><?php echo substr($project['title'], 0, 1); ?></span>
                <?php endif; ?>
            </div>

            <!-- Thumbnails -->
            <?php if (count($project['images']) > 1): ?>
            <div class="flex justify-center gap-3 overflow-x-auto pb-2 scrollbar-hide">
                <?php foreach ($project['images'] as $index => $img): ?>
                    <button @click="setImage(<?php echo $index; ?>)" 
                            class="shrink-0 w-24 h-16 md:w-32 md:h-20 rounded-lg border-2 transition-all cursor-pointer overflow-hidden relative"
                            :class="activeIndex === <?php echo $index; ?> ? 'border-primary opacity-100 ring-2 ring-primary/20' : 'border-transparent opacity-60 hover:opacity-100'">
                        <img src="<?php echo $img; ?>" class="w-full h-full object-cover">
                    </button>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>

        <!-- Project Header & Info -->
        <div class="max-w-4xl mx-auto">
            <div class="mb-8 text-center md:text-left">
                <h1 class="text-3xl md:text-5xl font-bold text-slate-900 mb-6"><?php echo $project['title']; ?></h1>
                
                <!-- Technologies -->
                <div class="flex flex-wrap gap-2 justify-center md:justify-start mb-8">
                    <?php foreach ($project['technologies'] as $tech): ?>
                        <span class="px-4 py-2 bg-slate-100 text-slate-700 font-medium rounded-full text-sm border border-slate-200">
                            <?php echo $tech; ?>
                        </span>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Description -->
            <div class="prose prose-lg prose-slate max-w-none text-slate-600 leading-relaxed mb-16">
                <h2 class="text-2xl font-bold text-slate-800 mb-4">About This Project</h2>
                <div class="bg-white rounded-2xl p-8 border border-slate-100 shadow-sm">
                    <p class="whitespace-pre-line"><?php echo $project['description']; ?></p>
                </div>
            </div>

            <!-- Contact / CTA Section -->
            <div class="bg-slate-900 rounded-3xl p-8 md:p-12 text-center text-white relative overflow-hidden">
                <!-- Decorative Gradients -->
                <div class="absolute top-0 right-0 w-64 h-64 bg-primary/20 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
                <div class="absolute bottom-0 left-0 w-64 h-64 bg-purple-500/20 rounded-full blur-3xl translate-y-1/2 -translate-x-1/2"></div>
                
                <div class="relative z-10">
                    <h2 class="text-3xl md:text-4xl font-bold mb-4">Interested in this project?</h2>
                    <p class="text-slate-300 mb-8 max-w-xl mx-auto text-lg">I can build a similar solution tailored to your specific needs. Let's discuss your requirements.</p>
                    
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="index.php#contact" class="inline-flex items-center justify-center px-8 py-4 bg-primary text-white font-bold rounded-full hover:bg-sky-600 transition-all shadow-lg shadow-sky-500/30 text-lg group">
                            Contact Me
                            <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                        <a href="https://wa.me/<?php echo str_replace('-', '', $data['profile']['contact']['mobile']); ?>" target="_blank" class="inline-flex items-center justify-center px-8 py-4 bg-white/10 text-white font-bold rounded-full hover:bg-white/20 transition-all border border-white/20 backdrop-blur-sm text-lg">
                            WhatsApp
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
