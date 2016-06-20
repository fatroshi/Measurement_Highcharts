<nav class="navbar well">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Startsida</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <?php
                    // Get all subjects
                    $subjects = $controller->allSubjects();
                    $output = "";
                    foreach ($subjects as $id => $name) {
                        $output .= "<li>";
                            // Get all subpages
                            $output .= "<div class=\"dropdown\">";
                                $output .="<button class=\"btn btn-primary dropdown-toggle\" type=\"button\" data-toggle=\"dropdown\">";
                                    $output .= $name . "  ";
                                $output .= "<span class=\"caret\"></span></button>";
                                $output .= "<ul class=\"dropdown-menu\">";
                                    //pages
                                    $pages = $controller->getSubjectItems($id);

                                    foreach ($pages as $page){
                                        $output .= "<li>";
                                            $output .= "<a href='page.php?subject_id={$id}&page={$page[0]}'>";
                                                $output .= $page[1];
                                            $output .= "</a>";
                                        $output .= "</li>";
                                    }

                                    $output .= "<li role=\"presentation\" class=\"divider\"></li>";
                                    $output .= "<li><a href=\"newItem.php?subject_id={$id}\"><span class=\"glyphicon glyphicon-plus\"></span> Sida</a></li>";
                                    $output .= "<li role=\"presentation\" class=\"divider\"></li>";
                                    $output .= "<li><a href=\"remove.php?subject_id={$id}&remove=subject\"><span class=\"glyphicon glyphicon-trash\"></span> " . $name . " </a></li>";
                                $output .="</ul>";
                            $output .= "</div>";
                        $output .= "</li>"; // END ALL SUBJECTS
                    }
                    echo $output;
                ?>
                <li><a href="newSubject.php"><span class="glyphicon glyphicon-plus"></span> Ämne</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>