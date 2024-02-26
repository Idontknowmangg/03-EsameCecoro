<!-- STRUTTURA DEL MENU' -->
<div class="menuToggle" title="Click here!"></div>
                <ul>
                    <li class="list active" style="--clr:#8FCEA0;">
                        <a href="#home">
                            <span class="icon" title="This is the page Home"><ion-icon name="home-outline"></ion-icon></span>
                            <span class="text">Home</span>
                        </a>
                    </li>
                    <li class="list" style="--clr:#8FCEA0;">
                        <a href="#strengths">
                            <span class="icon" title="This is my strengths"><ion-icon name="accessibility-outline"></ion-icon></span>
                            <span class="text">My strengths</span>
                        </a>
                    </li>
                    <li class="list" style="--clr:#8FCEA0;">
                        <a href="#projects">
                            <span class="icon" title="This is my projects"><ion-icon name="document-outline"></ion-icon></span>
                            <span class="text">My projects</span>
                        </a>
                    </li>
                    <li class="list" style="--clr:#8FCEA0;">
                        <a href="#form">
                            <span class="icon" title="This is the form"><ion-icon name="information-circle-outline"></ion-icon></span>
                            <span class="text">Form</span>
                        </a>
                    </li>
                    <?php
                        if (isset($_SESSION['loggedin']) || $_SESSION['loggedin'] === true) {
                            echo "<li class='list' style='--clr:#8FCEA0;'>";
                                echo "<a href='logout.php'>";
                                    echo "<span class='icon' title='This is logout'><ion-icon name='exit-outline'></ion-icon></span>";
                                    echo "<span class='text'>Logout</span>";
                            echo "</a>";
                        } else {
                            echo "Error 404: User not found";
                        }
                    ?>
                </ul>
                

