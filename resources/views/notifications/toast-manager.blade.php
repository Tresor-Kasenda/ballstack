<div
    x-data="{
        toasts: [],
        nextId: 0,

        add(toast) {
            toast.id = this.nextId++;
            this.toasts.push(toast);

            // Auto remove after duration
            if (toast.duration > 0) {
                setTimeout(() => {
                    this.remove(toast.id);
                }, toast.duration);
            }
        },

        remove(id) {
            const index = this.toasts.findIndex(t => t.id === id);
            if (index > -1) {
                this.toasts.splice(index, 1);
            }
        }
    }"
    @toast.window="add($event.detail)"
    class="toast-container"
>
    <template x-for="toast in toasts" :key="toast.id">
        <div
            x-show="true"
            x-transition:enter="transform transition ease-out duration-300"
            x-transition:enter-start="translate-y-2 opacity-0"
            x-transition:enter-end="translate-y-0 opacity-100"
            x-transition:leave="transform transition ease-in duration-200"
            x-transition:leave-start="translate-y-0 opacity-100"
            x-transition:leave-end="translate-y-2 opacity-0"
            :class="{
                'toast-top-right': toast.position === 'top-right',
                'toast-top-left': toast.position === 'top-left',
                'toast-bottom-right': toast.position === 'bottom-right',
                'toast-bottom-left': toast.position === 'bottom-left',
                'toast-top-center': toast.position === 'top-center',
                'toast-bottom-center': toast.position === 'bottom-center',
                'toast-success': toast.type === 'success',
                'toast-error': toast.type === 'error',
                'toast-warning': toast.type === 'warning',
                'toast-info': toast.type === 'info'
            }"
            class="toast"
            role="alert"
        >
            <div class="toast-content">
                <div class="toast-icon">
                    <template x-if="toast.type === 'success'">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </template>
                    <template x-if="toast.type === 'error'">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </template>
                    <template x-if="toast.type === 'warning'">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                    </template>
                    <template x-if="toast.type === 'info'">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </template>
                </div>
                <div class="toast-message" x-text="toast.message"></div>
                <button @click="remove(toast.id)" class="toast-close" aria-label="Close">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
    </template>
</div>

<style>
    .toast-container {
        position: fixed;
        z-index: 9999;
        pointer-events: none;
    }

    .toast {
        pointer-events: auto;
        margin-bottom: 1rem;
        background: white;
        border-radius: 0.5rem;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        max-width: 400px;
        min-width: 300px;
    }

    .toast-top-right {
        top: 1rem;
        right: 1rem;
        position: fixed;
    }

    .toast-top-left {
        top: 1rem;
        left: 1rem;
        position: fixed;
    }

    .toast-bottom-right {
        bottom: 1rem;
        right: 1rem;
        position: fixed;
    }

    .toast-bottom-left {
        bottom: 1rem;
        left: 1rem;
        position: fixed;
    }

    .toast-top-center {
        top: 1rem;
        left: 50%;
        transform: translateX(-50%);
        position: fixed;
    }

    .toast-bottom-center {
        bottom: 1rem;
        left: 50%;
        transform: translateX(-50%);
        position: fixed;
    }

    .toast-content {
        display: flex;
        align-items: center;
        padding: 1rem;
        gap: 0.75rem;
    }

    .toast-icon {
        flex-shrink: 0;
        width: 1.5rem;
        height: 1.5rem;
    }

    .toast-message {
        flex: 1;
        font-size: 0.875rem;
        line-height: 1.25rem;
        color: #1f2937;
    }

    .toast-close {
        flex-shrink: 0;
        background: transparent;
        border: none;
        cursor: pointer;
        padding: 0.25rem;
        border-radius: 0.25rem;
        transition: background-color 0.2s;
    }

    .toast-close:hover {
        background-color: rgba(0, 0, 0, 0.05);
    }

    .toast-success {
        border-left: 4px solid #1ee0ac;
    }

    .toast-success .toast-icon {
        color: #1ee0ac;
    }

    .toast-error {
        border-left: 4px solid #e85347;
    }

    .toast-error .toast-icon {
        color: #e85347;
    }

    .toast-warning {
        border-left: 4px solid #ffa353;
    }

    .toast-warning .toast-icon {
        color: #ffa353;
    }

    .toast-info {
        border-left: 4px solid #09c2de;
    }

    .toast-info .toast-icon {
        color: #09c2de;
    }
</style>
