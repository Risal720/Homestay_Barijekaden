<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
</head>
<body class="bg-[#ffffff] h-screen">

    <x-controlnav>{{ $tittle }}</x-controlnav>

    <div class="content-wrapper">
        <x-aside></x-aside>
        
        
        <main>
            <div id="main-content" class="main-content main-content-open">
            <!-- Your content -->
            {{ $slot }}
            </div>
        </main>
        
    </div>

    
</body>
</html>

<script>
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');
        const toggleSidebarBtn = document.getElementById('toggleSidebarBtn');
        const contentWrapper = document.querySelector('.content-wrapper');

        toggleSidebarBtn.addEventListener('click', () => {
            sidebar.classList.toggle('sidebar-open');
            sidebar.classList.toggle('sidebar-closed');
            mainContent.classList.toggle('main-content-open');
            mainContent.classList.toggle('main-content-closed');

            // Update margin-left of main content dynamically based on sidebar state
            if (sidebar.classList.contains('sidebar-open')) {
                mainContent.style.marginLeft = '160px';
            } else {
                mainContent.style.marginLeft = '50px';
            }
        });

        // Set initial margin-left based on initial sidebar state
        if (sidebar.classList.contains('sidebar-open')) {
            mainContent.style.marginLeft = '160px';
        } else {
            mainContent.style.marginLeft = '50px';
        }
</script>

<style>
        .sidebar {
            transition: width 0.5s ease-in-out;
            z-index: 20;
            height: calc(100vh - 64px);
            overflow-y: auto;
            overflow-x: hidden;
            position: fixed;
            top: 64px;
            left: 0;
        }
        .sidebar-open {
            width: 160px;
        }
        .sidebar-closed {
            width: 50px;
        }
        .sidebar-closed-icons svg {
            width: 24px;
            height: 24px;
        }
        .sidebar-open .nav-text {
            display: block;
        }
        .sidebar-closed .nav-text {
            display: none;
        }
        .main-content {
            transition: margin-left 0.5s ease-in-out;
            margin-left: 160px;
            padding: 1rem;
            overflow-y: auto;
            height: calc(100vh - 64px);
        }
        .main-content-closed {
            margin-left: 50px;
        }

        .top-navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 10;
            background-color: white;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
        }

        .content-wrapper {
            margin-top: 64px;
            display: flex;
            height: calc(100vh - 64px);
        }
        .norican-regular {
            font-family: 'Norican', cursive;
            font-size: 30px;
        }

        .nav-icon {
            width: 24px;
            height: 24px;
            margin-right: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .nav-icon svg {
            width: 100%;
            height: 100%;
        }
</style>

    