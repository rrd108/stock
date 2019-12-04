<header>
    <nav>
        <div class="title-bar" data-responsive-toggle="navbar" data-hide-for="medium">
            <button class="menu-icon" type="button" data-toggle="navbar"></button>
            <div class="title-bar-title"><?= __('Menu') ?></div>
        </div>

        <div data-sticky-container>
            <div class="top-bar" id="navbar" data-sticky data-options="marginTop:0;" style="width:100%">
                <div class="top-bar-left">
                    <?php if ($this->request->getSession()->read('Auth.User')) : ?>
                    <ul class="dropdown menu" data-dropdown-menu>
                        <li>
                            <?= $this->Html->image('logo.png') ?>
                        </li>
                        <li>
                            <?= $this->MenuLink->menuLink(
                                '<i class="fi-home"> ' . __('Home') . '</i>',
                                [
                                    'plugin' => false,
                                    'prefix' => false,
                                    'controller' => 'Stats',
                                    'action' => 'index'
                                ],
                                [
                                    'escape' => false
                                ]
                            ) ?>
                        </li>
                        <li>
                            <?= $this->MenuLink->menuLink(
                                '<i class="fi-book"> ' . __('Invoices') . '</i>',
                                [
                                    'plugin' => false,
                                    'prefix' => false,
                                    'controller' => 'invoices',
                                    'action' => 'index'
                                ],
                                [
                                    'escape' => false
                                ]
                            ) ?>
                            <ul class="nested vertical menu">
                                <li>
                                    <?= $this->MenuLink->menuLink(
                                        '<i class="fi-book"> ' . __('Invoices') . '</i>',
                                        [
                                            'plugin' => false,
                                            'prefix' => false,
                                            'controller' => 'invoices',
                                            'action' => 'index'
                                        ],
                                        [
                                            'escape' => false
                                        ]
                                    ) ?>
                                </li>
                                <li>
                                    <?= $this->MenuLink->menuLink(
                                        '<i class="fi-plus"> ' . __('New Invoice') . '</i>',
                                        [
                                            'plugin' => false,
                                            'prefix' => false,
                                            'controller' => 'invoices',
                                            'action' => 'add'
                                        ],
                                        ['escape' => false]
                                    ) ?>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <?= $this->MenuLink->menuLink(
                                '<i class="fi-list-thumbnails"> ' . __('Stock') . '</i>',
                                [
                                    'plugin' => false,
                                    'prefix' => false,
                                    'controller' => 'products',
                                    'action' => 'stock'
                                ],
                                [
                                    'escape' => false
                                ]
                            ) ?>
                        </li>
                        <li>
                            <?= $this->MenuLink->menuLink(
                                '<i class="fi-upload"> ' . __('Import') . '</i>',
                                [
                                    'plugin' => false,
                                    'prefix' => false,
                                    'controller' => 'invoices',
                                    'action' => 'import'
                                ],
                                [
                                    'escape' => false
                                ]
                            ) ?>
                        </li>
                        <li>
                            <?= $this->MenuLink->menuLink(
                                '<i class="fi-widget"> ' . __('Main data') . '</i>',
                                ['plugin' => false, 'prefix' => false,],
                                ['escape' => false]
                            ) ?>
                            <ul class="nested vertical menu">
                                <li><?= $this->MenuLink->menuLink(
                                        '<i class="fi-torso-business"> ' . __('Companies') . '</i>',
                                        ['plugin' => false, 'prefix' => false, 'controller' => 'companies', 'action' => 'index'],
                                        ['escape' => false]
                                    ) ?></li>
                                <li><?= $this->MenuLink->menuLink(
                                        '<i class="fi-contrast"> ' . __('Storages') . '</i>',
                                        ['plugin' => false, 'prefix' => false, 'controller' => 'storages', 'action' => 'index'],
                                        ['escape' => false]
                                    ) ?></li>
                                <li><?= $this->MenuLink->menuLink(
                                        '<i class="fi-torsos"> ' . __('Partners') . '</i>',
                                        ['plugin' => false, 'prefix' => false, 'controller' => 'partners', 'action' => 'index'],
                                        ['escape' => false]
                                    ) ?></li>
                                <li><?= $this->MenuLink->menuLink(
                                        '<i class="fi-foot"> ' . __('Products') . '</i>',
                                        ['plugin' => false, 'prefix' => false, 'controller' => 'products', 'action' => 'index'],
                                        ['escape' => false]
                                    ) ?></li>
                                <?php if ($this->request->getSession()->read('Auth.User.role') == 'superuser') : ?>
                                    <li><?= $this->MenuLink->menuLink(
                                            '<i class="fi-puzzle"> ' . __('Groups') . '</i>',
                                            ['plugin' => false, 'prefix' => 'admin', 'controller' => 'groups', 'action' => 'index'],
                                            ['escape' => false]
                                        ) ?></li>
                                    <li><?= $this->MenuLink->menuLink(
                                            '<i class="fi-shield"> ' . __('Invoice types') . '</i>',
                                            ['plugin' => false, 'prefix' => 'admin', 'controller' => 'invoicetypes', 'action' => 'index'],
                                            ['escape' => false]
                                        ) ?></li>
                                <?php endif; ?>
                            </ul>
                        </li>
                    </ul>
                    <?php endif; ?>
                </div>

                <div class="top-bar-right">
                    <ul class="menu">
                        <?php if ($this->request->getSession()->read('Auth.User')) : ?>
                            <li>
                                <?= $this->Html->link(
                                    '<i class="fi-torso"></i> ' . ($this->getRequest()->getSession()->read('company'))->name,
                                    ['plugin' => false, 'prefix' => false, 'controller' => 'Companies', 'action' => 'setDefault'],
                                    ['escape' => false]
                                ) ?>
                            </li>
                        <?php endif;?>
                        <li>
                            <?= $this->User->logout(
                                '<span id="username">'
                                    . $this->request->getSession()->read('Auth.User.username') .
                                '</span>'
                                . ' ' . __('Logout')
                                . ' ' . '<i class="fi-power"></i>',
                                ['escape' => false, 'prefix' => false]
                                        ) ?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>
