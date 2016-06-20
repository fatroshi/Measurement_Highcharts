<div class="container well">
<nav >
    <div id="navbar" class="collapse navbar-collapse ">
        <ul class="nav nav-justified">
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
                                    $output .= "<li >";
                                        $output .= "<a  href='page.php?subject_id={$id}&page={$page[0]}'>";
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
                <li><a class="btn btn-default " href="newSubject.php"><span class="glyphicut glyphicon-plus"></span> Ämne</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>