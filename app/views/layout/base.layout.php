<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard RP - École 221</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@4.6.0/fonts/remixicon.min.css">
        <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
        <!-- Icônes Heroicons -->
        <script src="https://unpkg.com/@heroicons/v2.0.18/24/outline/index.js"></script>
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        fontFamily: {
                            sans: ['poppins', 'sans-serif']
                        }
                    }
                }
            }
        </script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.0.0/remixicon.min.css" integrity="sha384-U5SeXb5CllCmI9DE/z9XKsEC5RPh8XmPoxvb5zF70h1GRAK2oymyXBy4x62wLydh" crossorigin="anonymous">
        <title>Sidebar</title>
    </head>
<body class="bg-gray-100">
    <div class="min-h-screen flex">
        <?php require_once ROOT_PATH . "/app/views/components/sidebar.php"; ?>
        <div class="flex-1 ml-72 px- space-y-8">
            <?php require_once ROOT_PATH . "/app/views/components/header.php"; ?>
            <section class="px-6 py-24 space-y-8">
                <?php require_once ROOT_PATH . "/app/views/components/stats.php"; ?>
                <?= $content ?>
            </section>
        </div>
    </div>
</body>
  
</html>