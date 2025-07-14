// Dashboard Interactive Features

class DashboardManager {
    constructor() {
        this.init();
    }

    init() {
        this.initializeAnimations();
        this.initializeCharts();
        this.initializeSearch();
        this.initializeNotifications();
        this.initializeQuickActions();
        this.initializeRealTimeUpdates();
    }

    // Initialize page load animations
    initializeAnimations() {
        // Animate stats cards on load
        const cards = document.querySelectorAll('.grid > div');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';
            setTimeout(() => {
                card.style.transition = 'all 0.8s cubic-bezier(0.4, 0, 0.2, 1)';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 150);
        });

        // Animate chart bars
        const chartBars = document.querySelectorAll('.bg-gradient-to-t');
        chartBars.forEach((bar, index) => {
            const originalHeight = bar.style.height;
            bar.style.height = '0%';
            setTimeout(() => {
                bar.style.transition = 'height 1.2s cubic-bezier(0.4, 0, 0.2, 1)';
                bar.style.height = originalHeight;
            }, index * 100 + 500);
        });

        // Add floating animation to icons
        const icons = document.querySelectorAll('.fas');
        icons.forEach(icon => {
            icon.classList.add('float-icon');
        });
    }

    // Initialize interactive charts
    initializeCharts() {
        const chartContainer = document.querySelector('.h-64');
        if (!chartContainer) return;

        // Add click handlers for chart period buttons
        const periodButtons = document.querySelectorAll('.bg-blue-100, .bg-gray-100');
        periodButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                // Remove active state from all buttons
                periodButtons.forEach(btn => {
                    btn.classList.remove('bg-blue-100', 'text-blue-600');
                    btn.classList.add('bg-gray-100', 'text-gray-600');
                });
                
                // Add active state to clicked button
                e.target.classList.remove('bg-gray-100', 'text-gray-600');
                e.target.classList.add('bg-blue-100', 'text-blue-600');
                
                // Simulate chart update
                this.updateChartData();
            });
        });
    }

    // Update chart data (simulated)
    updateChartData() {
        const bars = document.querySelectorAll('.bg-gradient-to-t');
        bars.forEach((bar, index) => {
            const newHeight = Math.random() * 80 + 20; // Random height between 20-100%
            bar.style.transition = 'height 0.8s cubic-bezier(0.4, 0, 0.2, 1)';
            bar.style.height = `${newHeight}%`;
        });
    }

    // Initialize search functionality
    initializeSearch() {
        const searchInput = document.querySelector('input[placeholder="Cari..."]');
        if (!searchInput) return;

        searchInput.addEventListener('input', (e) => {
            const searchTerm = e.target.value.toLowerCase();
            const tableRows = document.querySelectorAll('tbody tr');
            
            tableRows.forEach(row => {
                const text = row.textContent.toLowerCase();
                if (text.includes(searchTerm)) {
                    row.style.display = '';
                    row.style.opacity = '1';
                } else {
                    row.style.opacity = '0.3';
                }
            });
        });

        // Add search suggestions
        searchInput.addEventListener('focus', () => {
            searchInput.style.boxShadow = '0 0 0 3px rgba(59, 130, 246, 0.1)';
        });

        searchInput.addEventListener('blur', () => {
            searchInput.style.boxShadow = '';
        });
    }

    // Initialize notification system
    initializeNotifications() {
        // Add notification counter
        const notificationCard = document.querySelector('.bg-gradient-to-br.from-purple-500');
        if (notificationCard) {
            const counter = document.createElement('div');
            counter.className = 'absolute -top-2 -right-2 w-6 h-6 bg-red-500 text-white text-xs rounded-full flex items-center justify-center pulse';
            counter.textContent = '3';
            notificationCard.style.position = 'relative';
            notificationCard.appendChild(counter);
        }

        // Simulate real-time notifications
        setInterval(() => {
            this.showNotification();
        }, 30000); // Every 30 seconds
    }

    // Show notification toast
    showNotification() {
        const toast = document.createElement('div');
        toast.className = 'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg transform translate-x-full transition-transform duration-300 z-50';
        toast.innerHTML = `
            <div class="flex items-center">
                <i class="fas fa-check-circle mr-2"></i>
                <span>Transaksi baru berhasil diproses!</span>
            </div>
        `;
        
        document.body.appendChild(toast);
        
        // Animate in
        setTimeout(() => {
            toast.style.transform = 'translateX(0)';
        }, 100);
        
        // Animate out and remove
        setTimeout(() => {
            toast.style.transform = 'translateX(full)';
            setTimeout(() => {
                document.body.removeChild(toast);
            }, 300);
        }, 3000);
    }

    // Initialize quick action buttons
    initializeQuickActions() {
        const actionButtons = document.querySelectorAll('.bg-gradient-to-r button');
        actionButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                // Add ripple effect
                const ripple = document.createElement('span');
                const rect = button.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;
                
                ripple.style.width = ripple.style.height = size + 'px';
                ripple.style.left = x + 'px';
                ripple.style.top = y + 'px';
                ripple.className = 'absolute bg-white bg-opacity-30 rounded-full transform scale-0 animate-ping';
                
                button.style.position = 'relative';
                button.style.overflow = 'hidden';
                button.appendChild(ripple);
                
                setTimeout(() => {
                    button.removeChild(ripple);
                }, 600);
                
                // Show action feedback
                this.showActionFeedback(button.textContent.trim());
            });
        });
    }

    // Show action feedback
    showActionFeedback(action) {
        const feedback = document.createElement('div');
        feedback.className = 'fixed bottom-4 left-4 bg-blue-600 text-white px-4 py-2 rounded-lg shadow-lg transform translate-y-full transition-transform duration-300 z-50';
        feedback.textContent = `${action} sedang diproses...`;
        
        document.body.appendChild(feedback);
        
        setTimeout(() => {
            feedback.style.transform = 'translateY(0)';
        }, 100);
        
        setTimeout(() => {
            feedback.style.transform = 'translateY(full)';
            setTimeout(() => {
                document.body.removeChild(feedback);
            }, 300);
        }, 2000);
    }

    // Initialize real-time updates
    initializeRealTimeUpdates() {
        // Update time every minute
        setInterval(() => {
            this.updateTime();
        }, 60000);
        
        // Simulate data updates
        setInterval(() => {
            this.updateStats();
        }, 30000);
    }

    // Update current time
    updateTime() {
        const now = new Date();
        const timeString = now.toLocaleTimeString('id-ID', {
            hour: '2-digit',
            minute: '2-digit'
        });
        
        // Update any time displays
        const timeElements = document.querySelectorAll('.time-display');
        timeElements.forEach(element => {
            element.textContent = timeString;
        });
    }

    // Update stats with animation
    updateStats() {
        const statNumbers = document.querySelectorAll('.text-3xl.font-bold');
        statNumbers.forEach(number => {
            const currentValue = parseInt(number.textContent);
            const newValue = currentValue + Math.floor(Math.random() * 5);
            
            // Animate number change
            this.animateNumber(number, currentValue, newValue);
        });
    }

    // Animate number changes
    animateNumber(element, start, end) {
        const duration = 1000;
        const startTime = performance.now();
        
        const animate = (currentTime) => {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);
            
            const current = Math.floor(start + (end - start) * progress);
            element.textContent = current;
            
            if (progress < 1) {
                requestAnimationFrame(animate);
            }
        };
        
        requestAnimationFrame(animate);
    }

    // Export functionality
    exportData() {
        const exportButton = document.querySelector('button:has(.fa-download)');
        if (exportButton) {
            exportButton.addEventListener('click', () => {
                // Show export progress
                const originalText = exportButton.innerHTML;
                exportButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Mengekspor...';
                exportButton.disabled = true;
                
                setTimeout(() => {
                    exportButton.innerHTML = '<i class="fas fa-check mr-2"></i>Berhasil!';
                    setTimeout(() => {
                        exportButton.innerHTML = originalText;
                        exportButton.disabled = false;
                    }, 2000);
                }, 2000);
            });
        }
    }
}

// Initialize dashboard when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    new DashboardManager();
});

// Add smooth scrolling for better UX
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// Add keyboard shortcuts
document.addEventListener('keydown', (e) => {
    // Ctrl/Cmd + K for search
    if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
        e.preventDefault();
        const searchInput = document.querySelector('input[placeholder="Cari..."]');
        if (searchInput) {
            searchInput.focus();
        }
    }
    
    // Ctrl/Cmd + E for export
    if ((e.ctrlKey || e.metaKey) && e.key === 'e') {
        e.preventDefault();
        const exportButton = document.querySelector('button:has(.fa-download)');
        if (exportButton) {
            exportButton.click();
        }
    }
});

// Add responsive behavior
window.addEventListener('resize', () => {
    // Adjust chart height on mobile
    const chartContainer = document.querySelector('.h-64');
    if (chartContainer && window.innerWidth < 768) {
        chartContainer.style.height = '200px';
    } else if (chartContainer) {
        chartContainer.style.height = '256px';
    }
});