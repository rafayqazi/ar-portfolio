<?php require_once 'data.php'; ?>
<?php require_once 'includes/header.php'; ?>

<!-- Hero Section -->
<section class="min-h-screen flex items-center justify-center pt-20 relative overflow-hidden">
    <!-- Background Decor -->
    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-primary/10 rounded-full blur-3xl -z-10 animate-pulse"></div>
    <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-secondary/10 rounded-full blur-3xl -z-10 animate-pulse" style="animation-delay: 1s;"></div>

    <div class="container mx-auto px-6 grid md:grid-cols-2 gap-12 items-center">
        <div class="order-2 md:order-1 space-y-6 animate-slide-up">
            <h2 class="text-primary font-semibold tracking-wider uppercase text-sm">Hello, I'm</h2>
            <h1 class="text-5xl md:text-7xl font-bold text-white leading-tight">
                <?php echo $data['profile']['name']; ?>
            </h1>
            <p class="text-xl md:text-2xl text-slate-400 font-light">
                <?php echo $data['profile']['title']; ?>
            </p>
            <p class="text-slate-400 max-w-lg leading-relaxed">
                <?php echo $data['profile']['summary']; ?>
            </p>
            <div class="pt-4 flex gap-4">
                <a href="#portfolio" class="px-8 py-3 bg-primary text-white rounded-full font-semibold hover:bg-sky-600 transition-all shadow-lg shadow-sky-500/30">
                    View My Work
                </a>
                <a href="#contact" class="px-8 py-3 bg-slate-800 text-white rounded-full font-semibold hover:bg-slate-700 transition-all border border-slate-700">
                    Contact Me
                </a>
            </div>
        </div>
        
        <!-- Hero Image / Visual -->
        <div class="order-1 md:order-2 flex justify-center relative animate-fade-in">
            <div class="w-72 h-72 md:w-96 md:h-96 rounded-full border-4 border-slate-800 p-2 relative">
                <div class="w-full h-full rounded-full bg-slate-800 overflow-hidden relative">
                    <!-- Placeholder for User Image -->
                    <img src="https://ui-avatars.com/api/?name=Abdul+Rafeh&background=0f172a&color=0ea5e9&size=400" alt="Abdul Rafeh" class="object-cover w-full h-full hover:scale-105 transition-transform duration-500">
                </div>
                <!-- Orbiting badges could go here -->
            </div>
        </div>
    </div>
</section>

<!-- About & Skills Section -->
<section id="about" class="py-20 bg-slate-900/50">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">About & <span class="text-primary">Skills</span></h2>
            <div class="w-20 h-1 bg-primary mx-auto rounded-full"></div>
        </div>

        <div class="grid md:grid-cols-2 gap-12">
            <!-- About Content -->
            <div class="space-y-6 bg-slate-800/50 p-8 rounded-2xl border border-slate-700 hover:border-primary/50 transition-colors">
                <h3 class="text-2xl font-bold text-white mb-4">Personal Profile</h3>
                <div class="space-y-4 text-slate-400">
                    <p>
                        I am a passionate developer with expertise in building robust web applications using PHP and modern JavaScript frameworks. 
                        My journey started in 2018 with content writing, which evolved into full-stack development.
                    </p>
                    <ul class="space-y-2">
                        <li class="flex items-center gap-3">
                            <span class="w-2 h-2 bg-primary rounded-full"></span>
                            <span>Located in <?php echo $data['profile']['contact']['address']; ?></span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="w-2 h-2 bg-primary rounded-full"></span>
                            <span><?php echo $data['profile']['contact']['email']; ?></span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Skills Progress -->
            <div class="space-y-6">
                <?php foreach($data['skills']['programming'] as $skill): ?>
                <div>
                    <div class="flex justify-between mb-2">
                        <span class="font-semibold text-white"><?php echo $skill['name']; ?></span>
                        <span class="text-primary"><?php echo $skill['level']; ?>%</span>
                    </div>
                    <div class="w-full bg-slate-800 rounded-full h-2.5 overflow-hidden">
                        <div class="bg-primary h-2.5 rounded-full transition-all duration-1000 ease-out w-[<?php echo $skill['level']; ?>%]" style="width: <?php echo $skill['level']; ?>%"></div>
                    </div>
                </div>
                <?php endforeach; ?>
                
                <div class="mt-8 pt-6 border-t border-slate-800">
                    <h4 class="text-white font-semibold mb-4">Tools & Frameworks</h4>
                    <div class="flex flex-wrap gap-3">
                        <?php foreach($data['skills']['tools'] as $tool): ?>
                            <span class="px-3 py-1 bg-slate-800 text-sm text-slate-300 rounded-lg border border-slate-700 hover:border-primary transition-colors">
                                <?php echo $tool; ?>
                            </span>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Portfolio Section -->
<section id="portfolio" class="py-20" x-data="{ filter: 'All' }">
    <div class="container mx-auto px-6">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Featured <span class="text-primary">Projects</span></h2>
            <div class="w-20 h-1 bg-primary mx-auto rounded-full mb-8"></div>
            
            <!-- Filter Tabs -->
            <div class="flex flex-wrap justify-center gap-4 mb-8">
                <button @click="filter = 'All'" 
                        :class="filter === 'All' ? 'bg-primary text-white' : 'bg-slate-800 text-slate-400 hover:text-white hover:bg-slate-700'"
                        class="px-6 py-2 rounded-full font-medium transition-all duration-300">
                    All
                </button>
                <?php foreach(array_keys($data['portfolio']) as $cat): ?>
                <button @click="filter = '<?php echo $cat; ?>'" 
                        :class="filter === '<?php echo $cat; ?>' ? 'bg-primary text-white' : 'bg-slate-800 text-slate-400 hover:text-white hover:bg-slate-700'"
                        class="px-6 py-2 rounded-full font-medium transition-all duration-300">
                    <?php echo $cat; ?>
                </button>
                <?php endforeach; ?>
            </div>
            
            <p class="mt-4 text-slate-400">A collection of my work across Web Development, SEO, and Writing.</p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php 
            // Flatten the array for easier filtering
            $allProjects = [];
            foreach($data['portfolio'] as $category => $items) {
                foreach($items as $item) {
                    $item['category'] = $category;
                    $allProjects[] = $item;
                }
            }
            ?>

            <?php foreach($allProjects as $item): ?>
            <div x-show="filter === 'All' || filter === '<?php echo $item['category']; ?>'" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 class="group bg-slate-800 rounded-xl overflow-hidden hover:-translate-y-2 transition-transform duration-300 border border-slate-700 hover:border-primary/50 flex flex-col h-full cursor-none-target">
                
                <div class="h-48 bg-slate-700 relative overflow-hidden group-hover:bg-slate-600 transition-colors flex items-center justify-center shrink-0">
                    <?php if(isset($item['images']) && !empty($item['images'])): ?>
                        <img src="<?php echo $item['images'][0]; ?>" alt="<?php echo $item['title']; ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    <?php else: ?>
                        <span class="text-4xl text-slate-500 group-hover:text-primary transition-colors">
                            <?php if(strpos($item['category'], 'Web') !== false) echo '</>'; 
                                    elseif(strpos($item['category'], 'Writing') !== false) echo '¶';
                                    else echo '★'; ?>
                        </span>
                    <?php endif; ?>
                    
                    <!-- Category Badge -->
                    <span class="absolute top-4 right-4 bg-black/50 backdrop-blur text-xs text-white px-2 py-1 rounded">
                        <?php echo $item['category']; ?>
                    </span>
                </div>
                
                <div class="p-6 flex flex-col flex-grow">
                    <h4 class="text-xl font-bold text-white mb-2"><?php echo $item['title']; ?></h4>
                    <p class="text-slate-400 text-sm mb-4 flex-grow line-clamp-3"><?php echo $item['description']; ?></p>
                    
                    <a href="project.php?id=<?php echo $item['id']; ?>" class="inline-flex items-center text-primary text-sm font-semibold hover:underline mt-auto self-start">
                        View Details 
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Experience Section -->
<section id="experience" class="py-20 bg-slate-900/50">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">My <span class="text-primary">Experience</span></h2>
            <div class="w-20 h-1 bg-primary mx-auto rounded-full"></div>
        </div>
    
    <div class="relative max-w-4xl mx-auto">
        <!-- Timeline Line -->
        <div class="absolute left-0 md:left-1/2 h-full w-0.5 bg-slate-700 transform md:-translate-x-1/2"></div>
        
        <?php foreach($data['experience'] as $index => $exp): ?>
        <div class="relative mb-12 md:flex <?php echo ($index % 2 == 0) ? 'md:flex-row-reverse' : ''; ?> group">
            <!-- Dot -->
            <div class="absolute left-[-5px] md:left-1/2 w-3 h-3 bg-primary rounded-full transform md:-translate-x-1.5 mt-6 ring-4 ring-slate-900 group-hover:ring-primary/50 transition-all"></div>
            
            <div class="ml-8 md:ml-0 md:w-1/2 <?php echo ($index % 2 == 0) ? 'md:pl-12' : 'md:pr-12 text-right'; ?>">
                <div class="bg-slate-800 p-6 rounded-xl border border-slate-700 hover:border-primary/50 transition-all shadow-lg hover:shadow-primary/10">
                    <span class="inline-block px-3 py-1 bg-primary/10 text-primary text-xs rounded-full mb-3">
                        <?php echo $exp['period']; ?>
                    </span>
                    <h3 class="text-xl font-bold text-white mb-2"><?php echo $exp['role']; ?></h3>
                    <p class="text-slate-400 text-sm leading-relaxed">
                        <?php echo $exp['description']; ?>
                    </p>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="py-20">
    <div class="container mx-auto px-6 max-w-4xl">
         <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Get In <span class="text-primary">Touch</span></h2>
            <p class="text-slate-400">Have a project in mind? Let's discuss how we can work together.</p>
        </div>

        <div class="grid md:grid-cols-2 gap-12 bg-slate-800 p-8 rounded-2xl border border-slate-700">
            <div class="space-y-6">
                 <h3 class="text-2xl font-bold text-white">Contact Info</h3>
                 <div class="flex items-center gap-4 text-slate-300">
                     <div class="w-12 h-12 bg-slate-700 rounded-full flex items-center justify-center text-primary">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                     </div>
                     <div>
                         <p class="text-sm text-slate-500">Phone</p>
                         <p class="font-medium"><?php echo $data['profile']['contact']['mobile']; ?></p>
                     </div>
                 </div>
                 <div class="flex items-center gap-4 text-slate-300">
                     <div class="w-12 h-12 bg-slate-700 rounded-full flex items-center justify-center text-primary">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                     </div>
                     <div>
                         <p class="text-sm text-slate-500">Email</p>
                         <p class="font-medium"><?php echo $data['profile']['contact']['email']; ?></p>
                     </div>
                 </div>
            </div>
            
            <form class="space-y-4">
                <div>
                    <input type="text" placeholder="Your Name" class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-primary transition-colors hover:border-primary/50">
                </div>
                <div>
                    <input type="email" placeholder="Your Email" class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-primary transition-colors hover:border-primary/50">
                </div>
                <div>
                    <textarea rs="4" placeholder="Your Message" class="w-full bg-slate-900 border border-slate-700 rounded-lg px-4 py-3 text-white focus:outline-none focus:border-primary transition-colors h-32 hover:border-primary/50"></textarea>
                </div>
                <button type="submit" class="w-full bg-primary text-white font-bold py-3 rounded-lg hover:bg-sky-600 transition-colors shadow-lg shadow-sky-500/20">Send Message</button>
            </form>
        </div>
    </div>
</section>



<?php require_once 'includes/footer.php'; ?>
