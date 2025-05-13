document.addEventListener('DOMContentLoaded', function() {
    // Mobile sidebar elements
    const mobileSidebar = document.getElementById('mobile-sidebar');
    const mobileBackdrop = document.getElementById('mobile-sidebar-backdrop');
    const openButton = document.getElementById('open-sidebar');
    const closeButton = document.getElementById('close-sidebar');
    
    // Desktop sidebar elements
    const toggleButton = document.getElementById('toggle-sidebar');
    const desktopSidebar = document.getElementById('desktop-sidebar');
    
    // Check if elements exist before proceeding
    if (!mobileSidebar || !mobileBackdrop || !openButton || !closeButton || !toggleButton || !desktopSidebar) {
        console.error('One or more sidebar elements not found');
        return;
    }
    
    // Check localStorage for saved state
    const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
    if (isCollapsed) {
        collapseDesktopSidebar();
    }
    
    // Mobile sidebar handlers
    openButton.addEventListener('click', function() {
        mobileSidebar.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    });
    
    closeButton.addEventListener('click', function() {
        mobileSidebar.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    });
    
    mobileBackdrop.addEventListener('click', function() {
        mobileSidebar.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    });
    
    // Desktop sidebar toggle
    toggleButton.addEventListener('click', function() {
        if (desktopSidebar.classList.contains('md:w-20')) {
            expandDesktopSidebar();
        } else {
            collapseDesktopSidebar();
        }
    });
    
    function collapseDesktopSidebar() {
        desktopSidebar.classList.remove('md:w-64');
        desktopSidebar.classList.add('md:w-20');
        document.querySelectorAll('.sidebar-item-text').forEach(el => el.classList.add('hidden'));
        const sidebarLogo = document.querySelector('.sidebar-logo');
        if (sidebarLogo) sidebarLogo.classList.add('hidden');
        
        const toggleIcon = toggleButton.querySelector('svg');
        if (toggleIcon) toggleIcon.style.transform = 'rotate(180deg)';
        
        localStorage.setItem('sidebarCollapsed', 'true');
    }
    
    function expandDesktopSidebar() {
        desktopSidebar.classList.remove('md:w-20');
        desktopSidebar.classList.add('md:w-64');
        document.querySelectorAll('.sidebar-item-text').forEach(el => el.classList.remove('hidden'));
        const sidebarLogo = document.querySelector('.sidebar-logo');
        if (sidebarLogo) sidebarLogo.classList.remove('hidden');
        
        const toggleIcon = toggleButton.querySelector('svg');
        if (toggleIcon) toggleIcon.style.transform = 'rotate(0deg)';
        
        localStorage.setItem('sidebarCollapsed', 'false');
    }
});