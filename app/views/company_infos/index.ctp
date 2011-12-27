<div class="div-left-column">
    <div class="div-about-menus">
        <ul>
            <?php
            $is_first = true;
            foreach($company_infos as $company_info) {
                $url = array(
                    'controller' => 'company_infos',
                    'action' => 'index',
                    $company_info['CompanyInfo']['eng_name']
                );
                if($is_first) {
                    $url = array(
                        'controller' => 'company_infos',
                        'action' => 'index'
                    );
                    $is_first = false;
                }
                $link_str = $html->link($company_info['CompanyInfo']['caption'], $url);

                $is_current = $current_company_info['CompanyInfo']['id'] ==
                              $company_info['CompanyInfo']['id'];

                echo $html->tag('li', $link_str, array(
                    'class' => ($is_current)?"current":""
                ));
            }
            ?>
        </ul>
    </div>
</div>
<div class="div-right-column">
    <div class="div-current-about">
        <?php
        echo $html->tag('h1', $current_company_info['CompanyInfo']['caption']);
        echo $html->div('div-current-about-text', $current_company_info['CompanyInfo']['text']);
        ?>
    </div>
</div>
