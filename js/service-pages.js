const servicePageContent = {
    "saas-development": {
        title: "SaaS & Business Software Development",
        eyebrow: "Software built around your workflow",
        intro: "We build web-based business software that helps teams manage daily work, information, and reporting in one place. From focused internal tools to multi-user platforms, each solution starts with the workflow it needs to support.",
        offerings: [
            { title: "Business workflow systems", description: "Plan role-based screens and workflows around the way your team handles records, tasks, and approvals." },
            { title: "Dashboards and reporting", description: "Bring useful operational summaries, activity, and business reports into a clear dashboard." },
            { title: "Inventory and point of sale", description: "Manage products, stock, sales, returns, expenses, and customer or supplier ledgers." },
            { title: "School management tools", description: "Organize admissions, attendance, student records, fees, grading, and school reporting." }
        ],
        steps: [
            { title: "Understand the workflow", description: "Review the people, tasks, data, and problems the software needs to support." },
            { title: "Plan the product", description: "Agree on features, roles, screens, data structures, and a practical first release." },
            { title: "Build and review", description: "Develop in clear stages and review the working product against the requirements." },
            { title: "Test and launch", description: "Check key flows, prepare deployment, and provide handover for the delivered system." }
        ],
        projectIds: ["point-of-sale-pos", "school-management-system"]
    },
    "web-development": {
        title: "Custom Website Development",
        eyebrow: "Websites designed for real users",
        intro: "We design and develop responsive websites for businesses, organizations, and digital products. The work can cover a complete public-facing website or focused improvements to an existing web experience.",
        offerings: [
            { title: "Business and company websites", description: "Present services, company information, and clear contact paths in a polished website." },
            { title: "Custom web applications", description: "Build interactive front ends and connected features for practical business requirements." },
            { title: "Responsive user experiences", description: "Create layouts that adapt across phones, tablets, laptops, and larger screens." },
            { title: "Website improvements", description: "Refine existing site structure, usability, page speed, and maintainability." }
        ],
        steps: [
            { title: "Define the audience", description: "Understand who the website serves and what visitors need to accomplish." },
            { title: "Structure and design", description: "Organize pages and shape a consistent interface around the brand and content." },
            { title: "Develop responsively", description: "Build and review the website across common screen sizes and interactions." },
            { title: "Launch and hand over", description: "Complete checks, publish the site, and provide practical handover details." }
        ],
        projectIds: ["baja-call-center", "nawabshah-college", "university-ucc"]
    },
    "cms-customization": {
        title: "CMS & WordPress Customization",
        eyebrow: "Flexible content, easier updates",
        intro: "We customize content-managed websites so teams can maintain pages, publish information, and manage online content with less friction. Our portfolio includes WordPress and WooCommerce websites alongside custom educational and community sites.",
        offerings: [
            { title: "WordPress customization", description: "Adapt themes, page layouts, and site features to match a project’s content and brand." },
            { title: "WooCommerce setup", description: "Configure product catalogs, collections, shopping flows, and core store pages." },
            { title: "Content structure", description: "Organize pages and content types so common updates are straightforward to manage." },
            { title: "CMS fixes and improvements", description: "Improve an existing website’s presentation, mobile layout, and editorial experience." }
        ],
        steps: [
            { title: "Review the current site", description: "Identify the CMS, current content structure, and the changes your team needs." },
            { title: "Plan the structure", description: "Map page templates, content sections, and editing responsibilities." },
            { title: "Customize and populate", description: "Implement the agreed layouts and help prepare content for the new structure." },
            { title: "Review and hand over", description: "Test important pages and explain how to manage the updated site." }
        ],
        projectIds: ["rangeela-wear", "celebrity-wife", "literacy-master"]
    },
    "seo-optimization": {
        title: "Technical SEO & Website Optimization",
        eyebrow: "Make your website easier to discover",
        intro: "We improve the technical foundations and on-page structure that help search engines understand a website. SEO work is planned around the site, its content, and its audience—without promising rankings or traffic outcomes.",
        offerings: [
            { title: "Technical website review", description: "Review crawlability, indexing signals, site structure, mobile usability, and page performance." },
            { title: "On-page improvements", description: "Improve page titles, descriptions, headings, internal links, and content organization." },
            { title: "Keyword and content planning", description: "Identify relevant search topics and map them to useful, focused website pages." },
            { title: "Structured data and local basics", description: "Implement appropriate structured data and strengthen local business information where relevant." }
        ],
        steps: [
            { title: "Audit the website", description: "Review existing pages, technical setup, and the site’s current search visibility." },
            { title: "Prioritize opportunities", description: "Create a practical list of improvements based on impact, effort, and business goals." },
            { title: "Implement changes", description: "Update technical settings and on-page content in a controlled, reviewable way." },
            { title: "Measure and refine", description: "Monitor available search data and use it to plan the next improvements." }
        ],
        projectIds: []
    },
    "copywriting": {
        title: "Website, Product & SEO Copywriting",
        eyebrow: "Clear words for your brand and customers",
        intro: "We write useful, reader-focused content for business websites, online stores, and digital publications. Copy is shaped around the audience, the page goal, and the details you provide—without unsupported claims or keyword stuffing.",
        offerings: [
            { title: "Website and landing page copy", description: "Explain services, products, and next steps in clear language tailored to your audience." },
            { title: "E-commerce product descriptions", description: "Present product features, use cases, and key details in a scannable format." },
            { title: "SEO content and articles", description: "Plan and write relevant content with natural topic coverage and helpful structure." },
            { title: "Editing and content refinement", description: "Improve clarity, consistency, tone, and readability in existing copy." }
        ],
        steps: [
            { title: "Gather the details", description: "Understand the audience, offer, brand voice, source material, and desired action." },
            { title: "Plan the message", description: "Outline page sections and key points before drafting the copy." },
            { title: "Write and refine", description: "Prepare clear, audience-focused content and refine it with your feedback." },
            { title: "Prepare for publishing", description: "Deliver copy in an organized format ready for your website or store." }
        ],
        projectIds: ["nearpeer", "orator-magazine", "homehabitco"]
    }
};

function servicePage(id) {
    const service = servicePageContent[id];
    if (!service) {
        throw new Error(`Unknown service page: ${id}`);
    }

    return {
        data: portfolioData,
        service,
        menuOpen: false,
        get serviceProjects() {
            const projects = Object.values(this.data.portfolio).flat();
            return this.service.projectIds
                .map(id => projects.find(project => project.id === id))
                .filter(Boolean);
        }
    };
}
