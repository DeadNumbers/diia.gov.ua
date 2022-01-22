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

/* /var/www/sitefiles/themes/diia/partials/menu/header_pc_main_page.htm */
class __TwigTemplate_3114e8d600ed2a5e3b1b340f01c590a8cb7facb7fccbe73979ed0a4c0d54fe85 extends \Twig\Template
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
        echo "<div class=\"header_fixed\">
    <div class=\"header_fixed-inner\">
        <nav class=\"menu\">
            <ul class=\"menu_list\">
                ";
        // line 5
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["items"] ?? null));
        $context['loop'] = [
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        ];
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            if ( !twig_get_attribute($this->env, $this->source, $context["item"], "isHidden", [], "any", false, false, false, 5)) {
                // line 6
                echo "                    ";
                if ( !twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "items", [], "any", false, false, false, 6))) {
                    // line 7
                    echo "                        <li class=\"menu_list-item\">
                            <a href=\"";
                    // line 8
                    echo ((twig_get_attribute($this->env, $this->source, $context["item"], "url", [], "any", false, false, false, 8)) ? (KitSoft\Core\Twig\UrlFilter::url(twig_get_attribute($this->env, $this->source, $context["item"], "url", [], "any", false, false, false, 8))) : ("javascript:void(0)"));
                    echo "\" ";
                    if (twig_get_attribute($this->env, $this->source, $context["item"], "isExternal", [], "any", false, false, false, 8)) {
                        echo " target=\"_blank\" ";
                    }
                    echo " class=\"menu_list-link\">";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, false, 8), "html", null, true);
                    echo "</a>
                        </li>
                    ";
                } else {
                    // line 11
                    echo "                        <li class=\"menu_list-item\">
                            <a href=\"";
                    // line 12
                    echo ((twig_get_attribute($this->env, $this->source, $context["item"], "url", [], "any", false, false, false, 12)) ? (KitSoft\Core\Twig\UrlFilter::url(twig_get_attribute($this->env, $this->source, $context["item"], "url", [], "any", false, false, false, 12))) : ("javascript:void(0)"));
                    echo "\" class=\"menu_list-link menu_list-link-sub\" data-menu-target=\"menu-sub-";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["loop"], "index", [], "any", false, false, false, 12), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, false, 12), "html", null, true);
                    echo "</a>
                        </li>
                    ";
                }
                // line 15
                echo "                ";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 16
        echo "            </ul>
        </nav>
        <div class=\"header_sign-wrap\">
            <div class=\"header_sign\" id=\"header_sign\">
                <a href=\"";
        // line 20
        echo KitSoft\Core\Twig\UrlFilter::url(twig_get_attribute($this->env, $this->source, KitSoft\Pages\Twig\Filters::relationFinder(twig_get_attribute($this->env, $this->source, ($context["header"] ?? null), "registerLink", [], "any", false, false, false, 20)), "url", [], "any", false, false, false, 20));
        echo "\" class=\"btn btn_register\" ";
        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["header"] ?? null), "registerLink", [], "any", false, false, false, 20), "target", [], "any", false, false, false, 20)) {
            echo "target=\"_blank\"";
        }
        echo ">";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, KitSoft\Pages\Twig\Filters::relationFinder(twig_get_attribute($this->env, $this->source, ($context["header"] ?? null), "registerLink", [], "any", false, false, false, 20)), "title", [], "any", false, false, false, 20), "html", null, true);
        echo "</a>
                <a href=\"";
        // line 21
        echo KitSoft\Core\Twig\UrlFilter::url(twig_get_attribute($this->env, $this->source, KitSoft\Pages\Twig\Filters::relationFinder(twig_get_attribute($this->env, $this->source, ($context["header"] ?? null), "loginLink", [], "any", false, false, false, 21)), "url", [], "any", false, false, false, 21));
        echo "\" class=\"btn_sign js-btn_sign\" ";
        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["header"] ?? null), "loginLink", [], "any", false, false, false, 21), "target", [], "any", false, false, false, 21)) {
            echo "target=\"_blank\"";
        }
        echo ">";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, KitSoft\Pages\Twig\Filters::relationFinder(twig_get_attribute($this->env, $this->source, ($context["header"] ?? null), "loginLink", [], "any", false, false, false, 21)), "title", [], "any", false, false, false, 21), "html", null, true);
        echo "</a>
            </div>
            <div class=\"header_sign header_sign-auth\" id=\"header_sign-auth\">
                <a href=\"";
        // line 24
        echo KitSoft\Core\Twig\UrlFilter::url(twig_get_attribute($this->env, $this->source, KitSoft\Pages\Twig\Filters::relationFinder(twig_get_attribute($this->env, $this->source, ($context["header"] ?? null), "loginLink", [], "any", false, false, false, 24)), "url", [], "any", false, false, false, 24));
        echo "\" class=\"btn_sign-auth js-btn_sign-auth\" ";
        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["header"] ?? null), "loginLink", [], "any", false, false, false, 24), "target", [], "any", false, false, false, 24)) {
            echo "target=\"_blank\"";
        }
        echo "></a>
            </div>
        </div>
    </div>
    ";
        // line 28
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["items"] ?? null));
        $context['loop'] = [
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        ];
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            if ( !twig_get_attribute($this->env, $this->source, $context["item"], "isHidden", [], "any", false, false, false, 28)) {
                // line 29
                echo "        ";
                if (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "items", [], "any", false, false, false, 29))) {
                    // line 30
                    echo "            <div class=\"menu-sub\" id=\"menu-sub-";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["loop"], "index", [], "any", false, false, false, 30), "html", null, true);
                    echo "\">
                <div class=\"menu-sub_inner\">
                    <div class=\"container\">
                        <div class=\"row\">
                            ";
                    // line 34
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(twig_slice($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "items", [], "any", false, false, false, 34), 0, 2));
                    foreach ($context['_seq'] as $context["_key"] => $context["child"]) {
                        // line 35
                        echo "                                <div class=\"col-lg-6\">
                                    ";
                        // line 36
                        if ( !twig_get_attribute($this->env, $this->source, $context["child"], "isHidden", [], "any", false, false, false, 36)) {
                            // line 37
                            echo "                                        <a
                                            href=\"";
                            // line 38
                            echo ((twig_get_attribute($this->env, $this->source, $context["child"], "url", [], "any", false, false, false, 38)) ? (KitSoft\Core\Twig\UrlFilter::url(twig_get_attribute($this->env, $this->source, $context["child"], "url", [], "any", false, false, false, 38))) : ("javascript:void(0)"));
                            echo "\"
                                            ";
                            // line 39
                            if (twig_get_attribute($this->env, $this->source, $context["child"], "isExternal", [], "any", false, false, false, 39)) {
                                echo "target=\"_blank\" ";
                            }
                            // line 40
                            echo "                                            class=\"menu-sub_title\"
                                            >";
                            // line 41
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["child"], "title", [], "any", false, false, false, 41), "html", null, true);
                            echo "</a>
                                    ";
                        }
                        // line 43
                        echo "                                    ";
                        if (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, $context["child"], "items", [], "any", false, false, false, 43))) {
                            // line 44
                            echo "                                    <ul class=\"menu-sub_list\">
                                        ";
                            // line 45
                            $context['_parent'] = $context;
                            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["child"], "items", [], "any", false, false, false, 45));
                            foreach ($context['_seq'] as $context["_key"] => $context["subChild"]) {
                                if ( !twig_get_attribute($this->env, $this->source, $context["subChild"], "isHidden", [], "any", false, false, false, 45)) {
                                    // line 46
                                    echo "                                            <li class=\"menu-sub_list-item diia-animated\">
                                                <a href=\"";
                                    // line 47
                                    echo ((twig_get_attribute($this->env, $this->source, $context["subChild"], "url", [], "any", false, false, false, 47)) ? (KitSoft\Core\Twig\UrlFilter::url(twig_get_attribute($this->env, $this->source, $context["subChild"], "url", [], "any", false, false, false, 47))) : ("javascript:void(0)"));
                                    echo "\"
                                                   class=\"menu-sub_list-link\"
                                                   ";
                                    // line 49
                                    if (twig_get_attribute($this->env, $this->source, $context["subChild"], "isExternal", [], "any", false, false, false, 49)) {
                                        echo " target=\"_blank\"";
                                    }
                                    echo ">";
                                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["subChild"], "title", [], "any", false, false, false, 49), "html", null, true);
                                    echo "</a>
                                            </li>
                                        ";
                                }
                            }
                            $_parent = $context['_parent'];
                            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['subChild'], $context['_parent'], $context['loop']);
                            $context = array_intersect_key($context, $_parent) + $_parent;
                            // line 52
                            echo "                                    </ul>
                                    ";
                        }
                        // line 54
                        echo "                                </div>
                            ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['child'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 56
                    echo "                        </div>
                        ";
                    // line 57
                    if (((twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "items", [], "any", false, false, false, 57)) >= 3) && twig_get_attribute($this->env, $this->source, $context["loop"], "first", [], "any", false, false, false, 57))) {
                        // line 58
                        echo "                            <div class=\"hr-header\"></div>
                            <div class=\"row\">
                                ";
                        // line 60
                        $context['_parent'] = $context;
                        $context['_seq'] = twig_ensure_traversable(twig_slice($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "items", [], "any", false, false, false, 60), 2, 3));
                        foreach ($context['_seq'] as $context["_key"] => $context["child"]) {
                            // line 61
                            echo "                                    <div class=\"col-lg-6\">
                                        ";
                            // line 62
                            if ( !twig_get_attribute($this->env, $this->source, $context["child"], "isHidden", [], "any", false, false, false, 62)) {
                                // line 63
                                echo "                                            <a
                                                href=\"";
                                // line 64
                                echo ((twig_get_attribute($this->env, $this->source, $context["child"], "url", [], "any", false, false, false, 64)) ? (KitSoft\Core\Twig\UrlFilter::url(twig_get_attribute($this->env, $this->source, $context["child"], "url", [], "any", false, false, false, 64))) : ("javascript:void(0)"));
                                echo "\"
                                                ";
                                // line 65
                                if (twig_get_attribute($this->env, $this->source, $context["child"], "isExternal", [], "any", false, false, false, 65)) {
                                    echo "target=\"_blank\" ";
                                }
                                // line 66
                                echo "                                                class=\"menu-sub_list-link arrow\"
                                                >";
                                // line 67
                                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["child"], "title", [], "any", false, false, false, 67), "html", null, true);
                                echo "</a>
                                        ";
                            }
                            // line 69
                            echo "                                    </div>
                                ";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['child'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 71
                        echo "                            </div>
                        ";
                    }
                    // line 73
                    echo "                    </div>
                </div>
            </div>
        ";
                }
                // line 77
                echo "    ";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 78
        echo "</div>";
    }

    public function getTemplateName()
    {
        return "/var/www/sitefiles/themes/diia/partials/menu/header_pc_main_page.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  292 => 78,  282 => 77,  276 => 73,  272 => 71,  265 => 69,  260 => 67,  257 => 66,  253 => 65,  249 => 64,  246 => 63,  244 => 62,  241 => 61,  237 => 60,  233 => 58,  231 => 57,  228 => 56,  221 => 54,  217 => 52,  203 => 49,  198 => 47,  195 => 46,  190 => 45,  187 => 44,  184 => 43,  179 => 41,  176 => 40,  172 => 39,  168 => 38,  165 => 37,  163 => 36,  160 => 35,  156 => 34,  148 => 30,  145 => 29,  134 => 28,  123 => 24,  111 => 21,  101 => 20,  95 => 16,  85 => 15,  75 => 12,  72 => 11,  60 => 8,  57 => 7,  54 => 6,  43 => 5,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/sitefiles/themes/diia/partials/menu/header_pc_main_page.htm", "");
    }
}
