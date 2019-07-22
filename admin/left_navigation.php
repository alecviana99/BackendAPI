<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear">
                            <span class="block m-t-xs"> <strong class="font-bold">Admin</strong></span>
                            <span class="text-muted text-xs block">Administrator <b class="caret"></b></span>
                        </span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="login.html">Logout</a></li>
                    </ul>
                </div>
            </li>
            <li>
                <a href="./index.php"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
            </li>
            <li id="comics">
                <a href="#"><i class="fa fa-list-alt"></i> <span class="nav-label">Comics</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li id="new_comic"><a href="./editComic.php">New Comic</a></li>
                    <li id="view_comics"><a href="./view_comics.php">Comics</a></li>
                </ul>
            </li>
            <li id="episodes">
                <a href="#"><i class="fa fa-list-ol"></i> <span class="nav-label">Episodes</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li id="new_episode"><a href="./editEpisode.php">New Episode</a></li>
                    <li id="view_episodes"><a href="./view_episodes.php">Episodes</a></li>
                </ul>
            </li>
            <li id="panels">
                <a href="#"><i class="fa fa-list-ul"></i> <span class="nav-label">Panels</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level collapse">
                    <li id="new_panel"><a href="./editPanel.php">New Panel</a></li>
                    <li id="view_panels"><a href="./view_panels.php">Panels</a></li>
                </ul>
            </li>
            <li id="info">
                <a href="./info.php"><i class="fa fa-exclamation-circle"></i> <span class="nav-label">Info</span></a>
            </li>
            <li id="subscribes">
                <a href="./subscribes.php"><i class="fa fa-user"></i> <span class="nav-label">Subscribes</span></a>
            </li>
            <li id="settings">
                <a href="./settings.php"><i class="fa fa-cogs"></i> <span class="nav-label">Setting</span></a>
            </li>
        </ul>

    </div>
</nav>