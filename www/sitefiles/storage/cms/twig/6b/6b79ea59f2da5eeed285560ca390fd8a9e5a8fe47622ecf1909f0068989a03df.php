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

/* /var/www/sitefiles/themes/diia/partials/menu/header.htm */
class __TwigTemplate_680200acfa2d4812e143e87d91295d4fee4d8aeee9d10b3af59ae6a731bb5c56 extends \Twig\Template
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
        echo "<nav class=\"menu-m\">
    <div class=\"menu-m_content\">
        <div class=\"menu-m_top\">
            <a href=\"";
        // line 4
        echo KitSoft\Core\Twig\UrlFilter::url(url("/"));
        echo "\" class=\"menu-m_logo\">
                <div class=\"menu-m_logo-gerb\"></div>
                <div class=\"menu-m_logo-diya\"></div>
            </a>
            <div class=\"menu-m_search\">Пошук</div>
            <div class=\"menu-m_close\"></div>
        </div>
        <ul class=\"menu-m_list\">
            ";
        // line 12
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["items"] ?? null));
        $context['loop'] = [
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        ];
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 13
            echo "                ";
            if ( !twig_get_attribute($this->env, $this->source, $context["loop"], "last", [], "any", false, false, false, 13)) {
                // line 14
                echo "                    ";
                if ( !twig_get_attribute($this->env, $this->source, $context["item"], "isHidden", [], "any", false, false, false, 14)) {
                    // line 15
                    echo "                        ";
                    if ( !twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "items", [], "any", false, false, false, 15))) {
                        // line 16
                        echo "                            <li class=\"menu-m_list-item\">
                                <a href=\"";
                        // line 17
                        echo ((twig_get_attribute($this->env, $this->source, $context["item"], "url", [], "any", false, false, false, 17)) ? (KitSoft\Core\Twig\UrlFilter::url(twig_get_attribute($this->env, $this->source, $context["item"], "url", [], "any", false, false, false, 17))) : ("javascript:void(0)"));
                        echo "\" ";
                        if (twig_get_attribute($this->env, $this->source, $context["item"], "isExternal", [], "any", false, false, false, 17)) {
                            echo "target=\"_blank\" ";
                        }
                        echo " class=\"menu-m_link\">";
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, false, 17), "html", null, true);
                        echo "</a>
                            </li>
                        ";
                    } else {
                        // line 20
                        echo "                            <li class=\"menu-m_list-item\">
                                <a href=\"javascript:void(0)\" class=\"menu-m_link-childs\">";
                        // line 21
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, false, 21), "html", null, true);
                        echo "</a>
                                <div class=\"menu-m-sub_wrap\">
                                    ";
                        // line 23
                        $context['_parent'] = $context;
                        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["item"], "items", [], "any", false, false, false, 23));
                        foreach ($context['_seq'] as $context["_key"] => $context["child"]) {
                            if ( !twig_get_attribute($this->env, $this->source, $context["child"], "isHidden", [], "any", false, false, false, 23)) {
                                // line 24
                                echo "                                        ";
                                if (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, $context["child"], "items", [], "any", false, false, false, 24))) {
                                    // line 25
                                    echo "                                            <div class=\"menu-m-sub\">
                                                <a href=\"";
                                    // line 26
                                    echo ((twig_get_attribute($this->env, $this->source, $context["child"], "url", [], "any", false, false, false, 26)) ? (KitSoft\Core\Twig\UrlFilter::url(twig_get_attribute($this->env, $this->source, $context["child"], "url", [], "any", false, false, false, 26))) : ("javascript:void(0)"));
                                    echo "\" ";
                                    if (twig_get_attribute($this->env, $this->source, $context["child"], "isExternal", [], "any", false, false, false, 26)) {
                                        echo "target=\"_blank\" ";
                                    }
                                    echo " class=\"menu-m-sub_link-childs\">";
                                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["child"], "title", [], "any", false, false, false, 26), "html", null, true);
                                    echo "</a>
                                                <div class=\"menu-m-sub-sub\">
                                                    <div class=\"menu-m-sub-sub_top\">
                                                        <div class=\"menu-m-sub-sub_back\">";
                                    // line 29
                                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["child"], "title", [], "any", false, false, false, 29), "html", null, true);
                                    echo "</div>
                                                        <div class=\"menu-m-sub-sub_close\"></div>
                                                    </div>
                                                    ";
                                    // line 32
                                    $context['_parent'] = $context;
                                    $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["child"], "items", [], "any", false, false, false, 32));
                                    foreach ($context['_seq'] as $context["_key"] => $context["subChild"]) {
                                        if ( !twig_get_attribute($this->env, $this->source, $context["subChild"], "isHidden", [], "any", false, false, false, 32)) {
                                            // line 33
                                            echo "                                                    <div class=\"menu-m-sub-sub_item\">
                                                        <a href=\"";
                                            // line 34
                                            echo ((twig_get_attribute($this->env, $this->source, $context["subChild"], "url", [], "any", false, false, false, 34)) ? (KitSoft\Core\Twig\UrlFilter::url(twig_get_attribute($this->env, $this->source, $context["subChild"], "url", [], "any", false, false, false, 34))) : ("javascript:void(0)"));
                                            echo "\"
                                                           class=\"menu-m-sub-sub_link\"
                                                           ";
                                            // line 36
                                            if (twig_get_attribute($this->env, $this->source, $context["subChild"], "isExternal", [], "any", false, false, false, 36)) {
                                                echo " target=\"_blank\" ";
                                            }
                                            echo ">";
                                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["subChild"], "title", [], "any", false, false, false, 36), "html", null, true);
                                            echo "</a>
                                                    </div>
                                                    ";
                                        }
                                    }
                                    $_parent = $context['_parent'];
                                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['subChild'], $context['_parent'], $context['loop']);
                                    $context = array_intersect_key($context, $_parent) + $_parent;
                                    // line 39
                                    echo "                                                </div>
                                            </div>
                                        ";
                                } else {
                                    // line 42
                                    echo "                                            <div class=\"menu-m-sub\">
                                                <a href=\"";
                                    // line 43
                                    echo ((twig_get_attribute($this->env, $this->source, $context["child"], "url", [], "any", false, false, false, 43)) ? (KitSoft\Core\Twig\UrlFilter::url(twig_get_attribute($this->env, $this->source, $context["child"], "url", [], "any", false, false, false, 43))) : ("javascript:void(0)"));
                                    echo "\" ";
                                    if (twig_get_attribute($this->env, $this->source, $context["child"], "isExternal", [], "any", false, false, false, 43)) {
                                        echo "target=\"_blank\" ";
                                    }
                                    echo " class=\"menu-m-sub_link\">";
                                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["child"], "title", [], "any", false, false, false, 43), "html", null, true);
                                    echo "</a>
                                            </div>
                                        ";
                                }
                                // line 46
                                echo "                                    ";
                            }
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['child'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 47
                        echo "                                </div>
                            </li>
                        ";
                    }
                    // line 50
                    echo "                    ";
                }
                // line 51
                echo "                ";
            } else {
                // line 52
                echo "                    ";
                if ( !twig_get_attribute($this->env, $this->source, $context["item"], "isHidden", [], "any", false, false, false, 52)) {
                    // line 53
                    echo "                        ";
                    if (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "items", [], "any", false, false, false, 53))) {
                        // line 54
                        echo "                            <li class=\"menu-m_list-item\">
                                <a href=\"javascript:void(0)\" class=\"menu-m_link-childs\">";
                        // line 55
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, false, 55), "html", null, true);
                        echo "</a>
                                <div class=\"menu-m-sub_wrap\">
                                    ";
                        // line 57
                        $context['_parent'] = $context;
                        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["item"], "items", [], "any", false, false, false, 57));
                        foreach ($context['_seq'] as $context["_key"] => $context["child"]) {
                            // line 58
                            echo "                                        ";
                            if (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, $context["child"], "items", [], "any", false, false, false, 58))) {
                                // line 59
                                echo "                                        <div class=\"menu-m-sub\">
                                            ";
                                // line 60
                                $context['_parent'] = $context;
                                $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["child"], "items", [], "any", false, false, false, 60));
                                foreach ($context['_seq'] as $context["_key"] => $context["subChild"]) {
                                    if ( !twig_get_attribute($this->env, $this->source, $context["subChild"], "isHidden", [], "any", false, false, false, 60)) {
                                        // line 61
                                        echo "                                                <div class=\"menu-m-sub-sub_item\">
                                                    <a href=\"";
                                        // line 62
                                        echo ((twig_get_attribute($this->env, $this->source, $context["subChild"], "url", [], "any", false, false, false, 62)) ? (KitSoft\Core\Twig\UrlFilter::url(twig_get_attribute($this->env, $this->source, $context["subChild"], "url", [], "any", false, false, false, 62))) : ("javascript:void(0)"));
                                        echo "\"
                                                       class=\"menu-m-sub-sub_link\"
                                                       ";
                                        // line 64
                                        if (twig_get_attribute($this->env, $this->source, $context["subChild"], "isExternal", [], "any", false, false, false, 64)) {
                                            echo " target=\"_blank\" ";
                                        }
                                        echo ">";
                                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["subChild"], "title", [], "any", false, false, false, 64), "html", null, true);
                                        echo "</a>
                                                </div>
                                            ";
                                    }
                                }
                                $_parent = $context['_parent'];
                                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['subChild'], $context['_parent'], $context['loop']);
                                $context = array_intersect_key($context, $_parent) + $_parent;
                                // line 67
                                echo "                                        </div>
                                        ";
                            }
                            // line 69
                            echo "                                    ";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['child'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 70
                        echo "                                </div>
                            </li>
                        ";
                    }
                    // line 73
                    echo "                    ";
                }
                // line 74
                echo "                ";
            }
            // line 75
            echo "            ";
            ++$context['loop']['index0'];
            ++$context['loop']['index'];
            $context['loop']['first'] = false;
            if (isset($context['loop']['length'])) {
                --$context['loop']['revindex0'];
                --$context['loop']['revindex'];
                $context['loop']['last'] = 0 === $context['loop']['revindex0'];
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 76
        echo "        </ul>
    </div>
</nav>";
    }

    public function getTemplateName()
    {
        return "/var/www/sitefiles/themes/diia/partials/menu/header.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  282 => 76,  268 => 75,  265 => 74,  262 => 73,  257 => 70,  251 => 69,  247 => 67,  233 => 64,  228 => 62,  225 => 61,  220 => 60,  217 => 59,  214 => 58,  210 => 57,  205 => 55,  202 => 54,  199 => 53,  196 => 52,  193 => 51,  190 => 50,  185 => 47,  178 => 46,  166 => 43,  163 => 42,  158 => 39,  144 => 36,  139 => 34,  136 => 33,  131 => 32,  125 => 29,  113 => 26,  110 => 25,  107 => 24,  102 => 23,  97 => 21,  94 => 20,  82 => 17,  79 => 16,  76 => 15,  73 => 14,  70 => 13,  53 => 12,  42 => 4,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/sitefiles/themes/diia/partials/menu/header.htm", "");
    }
}
