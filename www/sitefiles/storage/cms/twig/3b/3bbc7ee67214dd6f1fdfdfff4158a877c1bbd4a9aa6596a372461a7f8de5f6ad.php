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

/* /var/www/sitefiles/themes/diia/partials/menu/header_pc_inner.htm */
class __TwigTemplate_6c0345d13d3eb5e1c226c3fa7f191e52c51afeffa1d33d057460a32afc17728b extends \Twig\Template
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
        echo "<div class=\"header-sm_fixed\">
    <div class=\"header-sm_fixed-inner\">
        <a href=\"";
        // line 3
        echo KitSoft\Core\Twig\UrlFilter::url(url("/"));
        echo "\" class=\"header-sm_logo\" title=\"На головну сторінку\">
            <div class=\"header-sm_logo-gerb\"></div>
            <div class=\"header-sm_logo-diya\"></div>
        </a>
        <nav class=\"menu\">
            <ul class=\"menu_list\">
                ";
        // line 9
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["items"] ?? null));
        $context['loop'] = [
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        ];
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            if ( !twig_get_attribute($this->env, $this->source, $context["item"], "isHidden", [], "any", false, false, false, 9)) {
                // line 10
                echo "                    ";
                if ( !twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "items", [], "any", false, false, false, 10))) {
                    // line 11
                    echo "                        <li class=\"menu_list-item\">
                            <a href=\"";
                    // line 12
                    echo ((twig_get_attribute($this->env, $this->source, $context["item"], "url", [], "any", false, false, false, 12)) ? (KitSoft\Core\Twig\UrlFilter::url(twig_get_attribute($this->env, $this->source, $context["item"], "url", [], "any", false, false, false, 12))) : ("javascript:void(0)"));
                    echo "\" ";
                    if (twig_get_attribute($this->env, $this->source, $context["item"], "isExternal", [], "any", false, false, false, 12)) {
                        echo " target=\"_blank\" ";
                    }
                    echo " class=\"menu_list-link\">";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, false, 12), "html", null, true);
                    echo "</a>
                        </li>
                    ";
                } else {
                    // line 15
                    echo "                        <li class=\"menu_list-item\">
                            <a href=\"";
                    // line 16
                    echo ((twig_get_attribute($this->env, $this->source, $context["item"], "url", [], "any", false, false, false, 16)) ? (KitSoft\Core\Twig\UrlFilter::url(twig_get_attribute($this->env, $this->source, $context["item"], "url", [], "any", false, false, false, 16))) : ("javascript:void(0)"));
                    echo "\" class=\"menu_list-link menu_list-link-sub\" data-menu-target=\"menu-sub-";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["loop"], "index", [], "any", false, false, false, 16), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, false, 16), "html", null, true);
                    echo "</a>
                        </li>
                    ";
                }
                // line 19
                echo "                ";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 20
        echo "            </ul>
        </nav>
        <div class=\"header-sm_search\">
            <form class=\"form form-search-sm\" action=\"";
        // line 23
        echo KitSoft\Core\Twig\UrlFilter::url(twig_get_attribute($this->env, $this->source, KitSoft\Core\Twig\Functions::getPageByTemplate("search"), "url", [], "any", false, false, false, 23));
        echo "\" method=\"GET\" id=\"form-search-site-sm\">
                <button class=\"btn form-search-sm_btn\"></button>
                <input type=\"search\" name=\"key\" class=\"input form-search-sm_input\" placeholder=\"Пошук\" autocomplete=\"off\">
                <div class=\"form-search-sm_error\" id=\"form-search-site-error\"></div>
                <div class=\"form-search-sm_close\"></div>
            </form>
        </div>
        <div class=\"header_sign-wrap\">
            <div class=\"header_sign\" id=\"header_sign\">
                <div class=\"header_sign-search icn_search js-header_sign-search\"></div>
                <a href=\"";
        // line 33
        echo KitSoft\Core\Twig\UrlFilter::url(twig_get_attribute($this->env, $this->source, KitSoft\Pages\Twig\Filters::relationFinder(twig_get_attribute($this->env, $this->source, ($context["header"] ?? null), "registerLink", [], "any", false, false, false, 33)), "url", [], "any", false, false, false, 33));
        echo "\" class=\"btn btn_register\" ";
        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["header"] ?? null), "registerLink", [], "any", false, false, false, 33), "target", [], "any", false, false, false, 33)) {
            echo "target=\"_blank\"";
        }
        echo ">";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, KitSoft\Pages\Twig\Filters::relationFinder(twig_get_attribute($this->env, $this->source, ($context["header"] ?? null), "registerLink", [], "any", false, false, false, 33)), "title", [], "any", false, false, false, 33), "html", null, true);
        echo "</a>
                <a href=\"";
        // line 34
        echo KitSoft\Core\Twig\UrlFilter::url(twig_get_attribute($this->env, $this->source, KitSoft\Pages\Twig\Filters::relationFinder(twig_get_attribute($this->env, $this->source, ($context["header"] ?? null), "loginLink", [], "any", false, false, false, 34)), "url", [], "any", false, false, false, 34));
        echo "\" class=\"btn_sign js-btn_sign\" ";
        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["header"] ?? null), "loginLink", [], "any", false, false, false, 34), "target", [], "any", false, false, false, 34)) {
            echo "target=\"_blank\"";
        }
        echo ">";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, KitSoft\Pages\Twig\Filters::relationFinder(twig_get_attribute($this->env, $this->source, ($context["header"] ?? null), "loginLink", [], "any", false, false, false, 34)), "title", [], "any", false, false, false, 34), "html", null, true);
        echo "</a>
            </div>
            <div class=\"header_sign header_sign-auth\" id=\"header_sign-auth\">
                <div class=\"header_sign-search icn_search js-header_sign-search\"></div>
                <a href=\"";
        // line 38
        echo KitSoft\Core\Twig\UrlFilter::url(twig_get_attribute($this->env, $this->source, KitSoft\Pages\Twig\Filters::relationFinder(twig_get_attribute($this->env, $this->source, ($context["header"] ?? null), "loginLink", [], "any", false, false, false, 38)), "url", [], "any", false, false, false, 38));
        echo "\" class=\"btn_sign-auth js-btn_sign-auth\" ";
        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["header"] ?? null), "loginLink", [], "any", false, false, false, 38), "target", [], "any", false, false, false, 38)) {
            echo "target=\"_blank\"";
        }
        echo "></a>
            </div>
        </div>
    </div>
    ";
        // line 42
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["items"] ?? null));
        $context['loop'] = [
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        ];
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            if ( !twig_get_attribute($this->env, $this->source, $context["item"], "isHidden", [], "any", false, false, false, 42)) {
                // line 43
                echo "        ";
                if (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "items", [], "any", false, false, false, 43))) {
                    // line 44
                    echo "            <div class=\"menu-sub\" id=\"menu-sub-";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["loop"], "index", [], "any", false, false, false, 44), "html", null, true);
                    echo "\">
                <div class=\"menu-sub_inner\">
                    <div class=\"container\">
                        <div class=\"row\">
                            ";
                    // line 48
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(twig_slice($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "items", [], "any", false, false, false, 48), 0, 2));
                    foreach ($context['_seq'] as $context["_key"] => $context["child"]) {
                        // line 49
                        echo "                                <div class=\"col-lg-6\">
                                    ";
                        // line 50
                        if ( !twig_get_attribute($this->env, $this->source, $context["child"], "isHidden", [], "any", false, false, false, 50)) {
                            // line 51
                            echo "                                        <a
                                            href=\"";
                            // line 52
                            echo ((twig_get_attribute($this->env, $this->source, $context["child"], "url", [], "any", false, false, false, 52)) ? (KitSoft\Core\Twig\UrlFilter::url(twig_get_attribute($this->env, $this->source, $context["child"], "url", [], "any", false, false, false, 52))) : ("javascript:void(0)"));
                            echo "\"
                                            ";
                            // line 53
                            if (twig_get_attribute($this->env, $this->source, $context["child"], "isExternal", [], "any", false, false, false, 53)) {
                                echo "target=\"_blank\" ";
                            }
                            // line 54
                            echo "                                            class=\"menu-sub_title\"
                                            >";
                            // line 55
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["child"], "title", [], "any", false, false, false, 55), "html", null, true);
                            echo "</a>
                                    ";
                        }
                        // line 57
                        echo "                                    ";
                        if (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, $context["child"], "items", [], "any", false, false, false, 57))) {
                            // line 58
                            echo "                                    <ul class=\"menu-sub_list\">
                                        ";
                            // line 59
                            $context['_parent'] = $context;
                            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["child"], "items", [], "any", false, false, false, 59));
                            foreach ($context['_seq'] as $context["_key"] => $context["subChild"]) {
                                if ( !twig_get_attribute($this->env, $this->source, $context["subChild"], "isHidden", [], "any", false, false, false, 59)) {
                                    // line 60
                                    echo "                                            <li class=\"menu-sub_list-item diia-animated\">
                                                <a href=\"";
                                    // line 61
                                    echo ((twig_get_attribute($this->env, $this->source, $context["subChild"], "url", [], "any", false, false, false, 61)) ? (KitSoft\Core\Twig\UrlFilter::url(twig_get_attribute($this->env, $this->source, $context["subChild"], "url", [], "any", false, false, false, 61))) : ("javascript:void(0)"));
                                    echo "\"
                                                   class=\"menu-sub_list-link\"
                                                   ";
                                    // line 63
                                    if (twig_get_attribute($this->env, $this->source, $context["subChild"], "isExternal", [], "any", false, false, false, 63)) {
                                        echo " target=\"_blank\"";
                                    }
                                    echo ">";
                                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["subChild"], "title", [], "any", false, false, false, 63), "html", null, true);
                                    echo "</a>
                                            </li>
                                        ";
                                }
                            }
                            $_parent = $context['_parent'];
                            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['subChild'], $context['_parent'], $context['loop']);
                            $context = array_intersect_key($context, $_parent) + $_parent;
                            // line 66
                            echo "                                    </ul>
                                    ";
                        }
                        // line 68
                        echo "                                </div>
                            ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['child'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 70
                    echo "                        </div>
                        ";
                    // line 71
                    if (((twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "items", [], "any", false, false, false, 71)) >= 3) && twig_get_attribute($this->env, $this->source, $context["loop"], "first", [], "any", false, false, false, 71))) {
                        // line 72
                        echo "                            <div class=\"hr-header\"></div>
                            <div class=\"row\">
                                ";
                        // line 74
                        $context['_parent'] = $context;
                        $context['_seq'] = twig_ensure_traversable(twig_slice($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "items", [], "any", false, false, false, 74), 2, 3));
                        foreach ($context['_seq'] as $context["_key"] => $context["child"]) {
                            // line 75
                            echo "                                    <div class=\"col-lg-6\">
                                        ";
                            // line 76
                            if ( !twig_get_attribute($this->env, $this->source, $context["child"], "isHidden", [], "any", false, false, false, 76)) {
                                // line 77
                                echo "                                            <a
                                                href=\"";
                                // line 78
                                echo ((twig_get_attribute($this->env, $this->source, $context["child"], "url", [], "any", false, false, false, 78)) ? (KitSoft\Core\Twig\UrlFilter::url(twig_get_attribute($this->env, $this->source, $context["child"], "url", [], "any", false, false, false, 78))) : ("javascript:void(0)"));
                                echo "\"
                                                ";
                                // line 79
                                if (twig_get_attribute($this->env, $this->source, $context["child"], "isExternal", [], "any", false, false, false, 79)) {
                                    echo "target=\"_blank\" ";
                                }
                                // line 80
                                echo "                                                class=\"menu-sub_list-link arrow\"
                                                >";
                                // line 81
                                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["child"], "title", [], "any", false, false, false, 81), "html", null, true);
                                echo "</a>
                                        ";
                            }
                            // line 83
                            echo "                                    </div>
                                ";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['child'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 85
                        echo "                            </div>
                        ";
                    }
                    // line 87
                    echo "                    </div>
                </div>
            </div>
        ";
                }
                // line 91
                echo "    ";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 92
        echo "</div>";
    }

    public function getTemplateName()
    {
        return "/var/www/sitefiles/themes/diia/partials/menu/header_pc_inner.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  312 => 92,  302 => 91,  296 => 87,  292 => 85,  285 => 83,  280 => 81,  277 => 80,  273 => 79,  269 => 78,  266 => 77,  264 => 76,  261 => 75,  257 => 74,  253 => 72,  251 => 71,  248 => 70,  241 => 68,  237 => 66,  223 => 63,  218 => 61,  215 => 60,  210 => 59,  207 => 58,  204 => 57,  199 => 55,  196 => 54,  192 => 53,  188 => 52,  185 => 51,  183 => 50,  180 => 49,  176 => 48,  168 => 44,  165 => 43,  154 => 42,  143 => 38,  130 => 34,  120 => 33,  107 => 23,  102 => 20,  92 => 19,  82 => 16,  79 => 15,  67 => 12,  64 => 11,  61 => 10,  50 => 9,  41 => 3,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/sitefiles/themes/diia/partials/menu/header_pc_inner.htm", "");
    }
}
