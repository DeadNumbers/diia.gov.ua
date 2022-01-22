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

/* /var/www/sitefiles/themes/diia/pages/search.htm */
class __TwigTemplate_6440f26a3e3dd25822aaf57334c5fcae43ab35630332699bd07c1ca3c63768db extends \Twig\Template
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
        $context['__cms_partial_params'] = [];
        echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("site/breadcrumbs"        , $context['__cms_partial_params']        , true        );
        unset($context['__cms_partial_params']);
        // line 2
        echo "<section>
    <div class=\"container search_container\">
        <div class=\"row\">
            <div class=\"col-12\">
                <form class=\"form form-search-page\" action=\"";
        // line 6
        echo KitSoft\Core\Twig\UrlFilter::url(twig_get_attribute($this->env, $this->source, KitSoft\Core\Twig\Functions::getPageByTemplate("search"), "url", [], "any", false, false, false, 6));
        echo "\" method=\"GET\" id=\"form_search-page\">
                    <input type=\"text\" class=\"input\" placeholder=\"Назва послуги або життєва ситуація\" id=\"form_search-page-input\" autocomplete=\"off\">
                    <button class=\"btn btn_search-page\"></button>
                </form>
            </div>
            <div class=\"col-12\">
                <div class=\"search_request-text\" id=\"search_request-text\"></div>
            </div>
            <div class=\"col-12\">
                <div class=\"search_empty\" id=\"search_empty\">
                    <div class=\"search_empty-msg\" id=\"search_empty-msg\">
                        За вашим запитом не знайдено матеріалів
                    </div>
                    <div class=\"search_empty-title\">Що з цим робити</div>
                    <div class=\"search_empty-list editor-content\">
                        <ul>
                            <li>Переконайтеся, що всі слова написані правильно.</li>
                            <li>Спробуйте інші ключові слова.</li>
                            <li>Спробуйте використати загальніші слова.</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class=\"col-md-4\">
                <div id=\"searchSideBarFilters\" class=\"search_tags-wrapper\">
                    <div class=\"search_tags\">
                        <div class=\"search_tags-title\">За типом матеріалу</div>
                        <div class=\"search_tags-list\">
                            <div class=\"search_tags-list-item\">
                                <div class=\"search_tags-theme\" data-theme=\"npa\">НПА</div>
                                <div class=\"search_tags-theme-count\">16</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class=\"col-md-8\">
                <div id=\"searchResultsContainer\" class=\"search-res_container\">
                    ";
        // line 69
        echo "                </div>
                <div class=\"load_wrap\">
                    <div class=\"load_more\" id=\"loadMore\" style=\"display: none;\">
                        <span class=\"load_more-text\">Завантажуємо ще</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Не натягиваем  -->
";
        // line 114
        echo "<!-- Не натягиваем  -->

";
        // line 116
        echo $this->env->getExtension('Cms\Twig\Extension')->startBlock('scripts'        );
        // line 117
        echo "    <script type=\"text/javascript\" src=\"";
        echo $this->extensions['Cms\Twig\Extension']->themeFilter([0 => "assets/javascript/build/search.bundle.js"]);
        echo "\"></script>
";
        // line 116
        echo $this->env->getExtension('Cms\Twig\Extension')->endBlock(true        );
    }

    public function getTemplateName()
    {
        return "/var/www/sitefiles/themes/diia/pages/search.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  113 => 116,  108 => 117,  106 => 116,  102 => 114,  88 => 69,  47 => 6,  41 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/sitefiles/themes/diia/pages/search.htm", "");
    }
}
