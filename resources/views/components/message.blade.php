<!-- Toast Container -->
<div id="toast-container">
    @if (session('success'))
        <div class="toast toast-success">
            {{ session('success') }}
        </div>
    @elseif(session('error'))
        <div class="toast toast-error">
            {{ session('error') }}
        </div>
    @endif
</div>

<style>
    #toast-container {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
    }

    /* Base toast style */
    .toast {
        padding: 12px 20px;
        border-radius: 8px;
        color: white;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
        min-width: 250px;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        margin-top: 10px;
        animation: fadeinout 4s forwards;
        /* Slide in & fade out */
    }

    /* Success & error colors */
    .toast-success {
        background-color: #4caf50;
        /* green */
    }

    .toast-error {
        background-color: #f44336;
        /* red */
    }

    /* Animation for appearing and disappearing */
    @keyframes fadeinout {
        0% {
            opacity: 0;
            transform: translateX(100%);
        }

        10% {
            opacity: 1;
            transform: translateX(0);
        }

        90% {
            opacity: 1;
            transform: translateX(0);
        }

        100% {
            opacity: 0;
            transform: translateX(100%);
        }
    }
</style>
