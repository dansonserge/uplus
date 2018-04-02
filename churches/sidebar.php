<aside id="sidebar_main">        
    <div class="sidebar_main_header">
        <div class="sidebar_logo">
            <a href="index.php" class="sSidebar_hide sidebar_logo_large">
                <img class="logo_regular" src="assets/img/logo_main.png" alt="" height="15" width="71"/>
                <img class="logo_light" src="assets/img/logo_main_white.png" alt="" height="15" width="71"/>
            </a>
            <a href="index-2.html" class="sSidebar_show sidebar_logo_small">
                <img class="logo_regular" src="assets/img/logo_main_small.png" alt="" height="32" width="32"/>
                <img class="logo_light" src="assets/img/logo_main_small_light.png" alt="" height="32" width="32"/>
            </a>
        </div>
        <div class="sidebar_actions">
            <select id="lang_switcher" name="lang_switcher">
                <option value="gb" selected>English</option>
            </select>
        </div>
    </div>
    
    <div class="menu_section">
        <ul>
            <li title="Dashboard">
                <a href="index.php">
                    <span class="menu_icon"><i class="material-icons">dashboard</i></span>
                    <span class="menu_title">Dashboard</span>
                </a>
                
            </li>


            <?php if($userType == 'admin'){?>
                <li title="Church">
                    <a href="churches.php">
                        <span class="menu_icon">
                        <i class="material-icons">call_to_action</i>
                        </span>
                        <span class="menu_title">Churches</span>
                    </a>
                </li>
                <li title="Church">
                    <a href="forums.php">
                        <span class="menu_icon">
                        <i class="material-icons">forum</i>
                        </span>
                        <span class="menu_title">Forums</span>
                    </a>
                </li>
            <?php }else if($userType == 'church'){?>

                <li title="Members">
                    <a href="members.php">
                        <span class="menu_icon">
                        <i class="material-icons"></i>
                        </span>
                        <span class="menu_title">Members</span>
                    </a>
                </li>
                <li title="Branches">
                    <a href="branches.php">
                        <span class="menu_icon">
                        <i class="material-icons"></i>
                        </span>
                        <span class="menu_title">Branches</span>
                    </a>
                </li>
                <li title="Groups">
                    <a href="groups.php">
                        <span class="menu_icon">
                        <i class="material-icons">group</i>
                        </span>
                        <span class="menu_title">Groups</span>
                    </a>                
                </li>
                <li title="Finance">
                    <a href="donations.php">
                        <span class="menu_icon"><i class="material-icons">&#xE8CB;</i></span>
                        <span class="menu_title">Donations</span>
                    </a>
                </li>
                <li title="Communication">
                    <a class="nolink" href="">
                        <span class="menu_icon"><i class="material-icons">comment</i></span>
                        <span class="menu_title">Communication</span>
                    </a>
                    <ul>
                        <li>
                            <a href="prayer_request.php">Prayer Requests</a>
                        </li>
                        <li>
                            <a href="broadcast.php">Broadcast</a>
                        </li>
                        <li>
                            <a href="invoices.php">Invoices</a>
                        </li>
                        <li>
                            <a href="feeds.php">Feeds</a>
                        </li>
                    </ul>
                </li>
                <li title="Events">
                    <a href="events.php">
                        <span class="menu_icon">
                        <i class="material-icons"></i>
                        </span>
                        <span class="menu_title">Events</span>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </div>
</aside><!-- main sidebar end -->