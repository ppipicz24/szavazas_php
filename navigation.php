<nav>
    <br>
    <?php if(isset($_SESSION['user']) && $_SESSION['user']=="admin") :?>
        <div>
            <a href="./add_poll.php"><button class='ghost-round'>Új szavazó oldal hozzáadása</button></a>
            <a href="./logout.php"><button class='ghost-round'>Kijelentkezés</button></a>
        </div>
    <?php elseif(isset($_SESSION['user'])) : ?>
        <div>
            <a href="./logout.php"><button class='ghost-round'>Kijelentkezés</button></a>
        </div>
        <?php else : ?>
        <div>
            <a href="./login.php"><button class='ghost-round'>Bejelentkezés</button></a>
            <a href="./register.php"><button class='ghost-round'>Regisztráció</button></a>
    <?php endif ?>
</nav>