<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* /var/www/sitefiles/themes/diia/partials/site/ieBlock.htm */
class __TwigTemplate_f0966ecdad647d4662114dbe34a31b2d1652417ee92d9e8adadfb6bb9d4e3001 extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<div class=\"browser_container\">
    <!--  HEADER  -->
    <div class=\"browser_header\">
        <div class=\"browser_header-version\">
            <div class=\"browser_header-title\">Outdated Browser</div>
            <div class=\"browser_header-text\">Для комфортної роботи в Мережі потрібен сучасний браузер. Тут можна знайти останні версії.</div>
        </div>
        <div class=\"browser_header-version-m\">
            <div class=\"browser_header-title\">Outdated Browser</div>
            <div class=\"browser_header-text\">Цей сайт призначений для комп'ютерів, але <br>ви можете вільно користуватися ним.</div>
        </div>
    </div>
    <section class=\"browser_list\">
        <!-- BROWSER - Chrome -->
        <div class=\"browser browser-chrome\">
            <div class=\"browser_statistic\">
                <div class=\"browser_statistic-big\">67.15%</div>
                <div class=\"browser_statistic-small\">людей використовує<br>цей браузер</div>
            </div>
            <div class=\"browser-center\">
                <div class=\"browser-logo chrome\"></div>
                <div class=\"browser-name\">Google Chrome</div>
                <div class=\"browser_load\">
                    <a href=\"https://www.google.com/chrome/browser/desktop\" target=\"_blank\" class=\"browser_load-link chrome\">Завантажити</a>
                </div>
            </div>
            <div class=\"browser_available\">
                <div class=\"browser_available-title\">
                    Доступно для
                </div>
                <ul class=\"browser_os\">
                    <li class=\"browser_os-item windows\">
                        <span>Windows</span>
                    </li>
                    <li class=\"browser_os-item mac\">
                        <span>Mac OS</span>
                    </li>
                    <li class=\"browser_os-item linux\">
                        <span>Linux</span>
                    </li>
                </ul>
            </div>
        </div>
        <!-- BROWSER - Firefox -->
        <div class=\"browser browser-firefox\">
            <div class=\"browser_statistic\">
                <div class=\"browser_statistic-big\">9.6%</div>
                <div class=\"browser_statistic-small\">людей використовує<br>цей браузер</div>
            </div>
            <div class=\"browser-center\">
                <div class=\"browser-logo firefox\"></div>
                <div class=\"browser-name\">Mozilla Firefox</div>
                <div class=\"browser_load\">
                    <a href=\"https://www.mozilla.org/firefox/new/\" target=\"_blank\" class=\"browser_load-link firefox\">Завантажити</a>
                </div>
            </div>
            <div class=\"browser_available\">
                <div class=\"browser_available-title\">
                    Доступно для
                </div>
                <ul class=\"browser_os\">
                    <li class=\"browser_os-item windows\">
                        <span>Windows</span>
                    </li>
                    <li class=\"browser_os-item mac\">
                        <span>Mac OS</span>
                    </li>
                    <li class=\"browser_os-item linux\">
                        <span>Linux</span>
                    </li>
                </ul>
            </div>
        </div>
        <!-- BROWSER - Internet Explorer -->
        <div class=\"browser browser-edge\">
            <div class=\"browser_statistic\">
                <div class=\"browser_statistic-big\">4.5%</div>
                <div class=\"browser_statistic-small\">людей використовує<br>цей браузер</div>
            </div>
            <div class=\"browser-center\">
                <div class=\"browser-logo edge\"></div>
                <div class=\"browser-name\">Microsoft Edge</div>
                <div class=\"browser_load\">
                    <a href=\"https://www.microsoft.com/software-download/windows10\" target=\"_blank\" class=\"browser_load-link edge\">Завантажити</a>
                    <div class=\"browser_load-info\">Доступний тільки з Windows 10</div>
                </div>
            </div>
            <div class=\"browser_available\">
                <div class=\"browser_available-title\">
                    Доступно для
                </div>
                <ul class=\"browser_os\">
                    <li class=\"browser_os-item windows\">
                        <span>Windows</span>
                    </li>
                </ul>
            </div>
        </div>
        <!-- BROWSER - Safari -->
        <div class=\"browser browser-safari\">
            <div class=\"browser_statistic\">
                <div class=\"browser_statistic-big\">6.5%</div>
                <div class=\"browser_statistic-small\">людей використовує<br>цей браузер</div>
            </div>
            <div class=\"browser-center\">
                <div class=\"browser-logo safari\"></div>
                <div class=\"browser-name\">Apple Safari</div>
                <div class=\"browser_load\">
                    <a href=\"https://www.apple.com/macos/how-to-upgrade/\" target=\"_blank\" class=\"browser_load-link safari\">Завантажити</a>
                    <div class=\"browser_load-info\">Доступний тільки з macOS</div>
                </div>
            </div>
            <div class=\"browser_available\">
                <div class=\"browser_available-title\">
                    Доступно для
                </div>
                <ul class=\"browser_os\">
                    <li class=\"browser_os-item mac\">
                        <span>Mac OS</span>
                    </li>
                </ul>
            </div>
        </div>
        <!-- BROWSER - Opera -->
        <div class=\"browser browser-opera\">
            <div class=\"browser_statistic\">
                <div class=\"browser_statistic-big\">3.15%</div>
                <div class=\"browser_statistic-small\">людей використовує<br>цей браузер</div>
            </div>
            <div class=\"browser-center\">
                <div class=\"browser-logo opera\"></div>
                <div class=\"browser-name\">Opera</div>
                <div class=\"browser_load\">
                    <a href=\"https://www.opera.com/computer\" target=\"_blank\" class=\"browser_load-link opera\">Завантажити</a>
                </div>
            </div>
            <div class=\"browser_available\">
                <div class=\"browser_available-title\">
                    Доступно для
                </div>
                <ul class=\"browser_os\">
                    <li class=\"browser_os-item windows\">
                        <span>Windows</span>
                    </li>
                    <li class=\"browser_os-item mac\">
                        <span>Mac OS</span>
                    </li>
                    <li class=\"browser_os-item linux\">
                        <span>Linux</span>
                    </li>
                </ul>
            </div>
        </div>
    </section>
</div>
<script async>
(function() {
    var IE10 = ( window.navigator.userAgent.indexOf('MSIE') > -1 ? true : false );
    var IE11 = ( window.navigator.userAgent.indexOf(\"Trident\") > -1 ? true : false );
    if ( IE10 || IE11 ) {
        var items = document.querySelectorAll('.browser');
        if (items.length) {
            for (var i = 0; i < items.length; i++) {
                items[i].addEventListener('mouseenter', function(e) {
                    var target = e.target;
                    target.className.indexOf('browser-expanded') > -1 ? '' : target.classList.add('browser-expanded');
                });
                items[i].addEventListener('mouseleave', function(e) {
                    var target = e.target;
                    target.className.indexOf('browser-expanded') > -1 ? target.classList.remove('browser-expanded') : '';
                });
            }
        }
    }
})();
</script>";
    }

    public function getTemplateName()
    {
        return "/var/www/sitefiles/themes/diia/partials/site/ieBlock.htm";
    }

    public function getDebugInfo()
    {
        return array (  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/sitefiles/themes/diia/partials/site/ieBlock.htm", "");
    }
}
