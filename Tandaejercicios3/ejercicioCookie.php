<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>Create a web page with a form to choose the language in which it is displayed, English or Spanish. Stores the user's choice with a cookie so that the next time the user logs on the page appears directly in their language. If the cookie does not exist, the page will be displayed in Spanish.</p>

    <?php 
        // Function to set the language cookie
        function setLanguageCookie($language) {
            setcookie('language', $language, time() + 365 * 24 * 3600, '/');
        }

        // Function to get the language from the cookie or default to Spanish
        function getLanguageFromCookie() {
            if (isset($_COOKIE['language'])) {
                return $_COOKIE['language'];
            }
            return 'es'; // Default to Spanish if the cookie doesn't exist
        }

        // Handle form submission
        if (isset($_POST['language'])) {
            $selectedLanguage = $_POST['language'];
            setLanguageCookie($selectedLanguage);
        } else {
            $selectedLanguage = getLanguageFromCookie();
        }

        ?>

        <form method="post" action="">
            <label for="language">Select Language:</label>
            <select name="language" id="language">
                <option value="en" <?php if ($selectedLanguage === 'en') echo 'selected'; ?>>English</option>
                <option value="es" <?php if ($selectedLanguage === 'es') echo 'selected'; ?>>Spanish</option>
            </select>
            <input type="submit" value="Submit">
        </form>

        <!-- Display content based on selected language -->
        <?php
        if ($selectedLanguage === 'en') {
            echo "<h1>Welcome to our website</h1>";
            echo "<p>This is the English version of the page.</p>";
        } else {
            echo "<h1>Bienvenidos a nuestro sitio web</h1>";
            echo "<p>Esta es la versión en español de la página.</p>";
        }
        ?>
</body>
</html>