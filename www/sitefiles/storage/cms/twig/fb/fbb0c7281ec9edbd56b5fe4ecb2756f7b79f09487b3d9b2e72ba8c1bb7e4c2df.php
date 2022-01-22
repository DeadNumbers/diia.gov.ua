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

/* /var/www/sitefiles/themes/diia/partials/site/sections/newsLast.htm */
class __TwigTemplate_8e7ac555dc5dae957d130ee984008b89d650eb6f8b018f27f537a5ce785a8bf1 extends \Twig\Template
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
        // line 2
        echo "
";
        // line 3
        if ((($context["data"] ?? null) && twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["newsLast"] ?? null), "posts", [], "any", false, false, false, 3)))) {
            // line 4
            echo "<section class=\"main-item_news-section\">
    <div class=\"container\">
        <div class=\"row\">
            <div class=\"col-6\">
                <h1 class=\"article-level-1 text-white\">";
            // line 8
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "title", [], "any", false, false, false, 8), "html", null, true);
            echo "</h1>
            </div>
            <div class=\"col-6\">
                <div class=\"wrap-all-link\">
                    <a href=\"";
            // line 12
            echo KitSoft\Core\Twig\UrlFilter::url(twig_get_attribute($this->env, $this->source, KitSoft\Core\Twig\Functions::getPageByTemplate("posts"), "url", [], "any", false, false, false, 12));
            echo "\" class=\"wrap-all-link_link-white\">
                        <span>";
            // line 13
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "link", [], "any", false, false, false, 13), "title", [], "any", false, false, false, 13), "html", null, true);
            echo "</span>
                    </a>
                </div>
            </div>
        </div>
        <div class=\"row\">
            <div class=\"col-lg-6\">
                ";
            // line 20
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_slice($this->env, twig_get_attribute($this->env, $this->source, ($context["newsLast"] ?? null), "posts", [], "any", false, false, false, 20), 0, 1));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 21
                echo "                <div class=\"main-item_news-top\">
                    ";
                // line 22
                if (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "featured_images", [], "any", false, false, false, 22))) {
                    // line 23
                    echo "                        <div class=\"main-item_news-preview\" style=\"background-image: url('";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_first($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "featured_images", [], "any", false, false, false, 23)), "path", [], "any", false, false, false, 23), "html", null, true);
                    echo "')\">
                        </div>
                    ";
                } else {
                    // line 26
                    echo "                        <div class=\"main-item_news-preview\" style=\"background-image: url('";
                    echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/images/posts_item-preview.svg");
                    echo "');\">
                        </div>
                    ";
                }
                // line 29
                echo "                    <div class=\"main-item_news-content\">
                        ";
                // line 30
                if (twig_get_attribute($this->env, $this->source, $context["item"], "published_at", [], "any", false, false, false, 30)) {
                    // line 31
                    echo "                        <div class=\"main-item_news-content-date\">
                            ";
                    // line 32
                    echo twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "published_at", [], "any", false, false, false, 32), "d/m/Y"), "html", null, true);
                    echo "
                        </div>
                        ";
                } else {
                    // line 35
                    echo "                        <div class=\"main-item_news-content-date\">
                            ";
                    // line 36
                    echo twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "created_at", [], "any", false, false, false, 36), "d/m/Y"), "html", null, true);
                    echo "
                        </div>
                        ";
                }
                // line 39
                echo "                        <a href=\"";
                echo KitSoft\Core\Twig\UrlFilter::url(twig_get_attribute($this->env, $this->source, $context["item"], "url", [], "any", false, false, false, 39));
                echo "\" class=\"main-item_news-content-title\">
                            ";
                // line 40
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, false, 40), "html", null, true);
                echo "
                        </a>
                    </div>
                </div>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 45
            echo "            </div>
            <div class=\"col-lg-6\">
                <div class=\"row\">
                    ";
            // line 48
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_slice($this->env, twig_get_attribute($this->env, $this->source, ($context["newsLast"] ?? null), "posts", [], "any", false, false, false, 48), 1, 5));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 49
                echo "                    <div class=\"col-6\">
                        <div class=\"main-item\">
                            <div class=\"main-item_content\">
                                ";
                // line 52
                if (twig_get_attribute($this->env, $this->source, $context["item"], "published_at", [], "any", false, false, false, 52)) {
                    // line 53
                    echo "                                <div class=\"main-item_content-date\">
                                    ";
                    // line 54
                    echo twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "published_at", [], "any", false, false, false, 54), "d/m/Y"), "html", null, true);
                    echo "
                                </div>
                                ";
                } else {
                    // line 57
                    echo "                                <div class=\"main-item_content-date\">
                                    ";
                    // line 58
                    echo twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "created_at", [], "any", false, false, false, 58), "d/m/Y"), "html", null, true);
                    echo "
                                </div>
                                ";
                }
                // line 61
                echo "                                <a href=\"";
                echo KitSoft\Core\Twig\UrlFilter::url(twig_get_attribute($this->env, $this->source, $context["item"], "url", [], "any", false, false, false, 61));
                echo "\" class=\"main-item_content-title\">";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, false, 61), "html", null, true);
                echo "</a>
                            </div>
                        </div>
                    </div>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 66
            echo "                </div>
            </div>
        </div>
    </div>
</section>
";
        }
    }

    public function getTemplateName()
    {
        return "/var/www/sitefiles/themes/diia/partials/site/sections/newsLast.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  179 => 66,  165 => 61,  159 => 58,  156 => 57,  150 => 54,  147 => 53,  145 => 52,  140 => 49,  136 => 48,  131 => 45,  120 => 40,  115 => 39,  109 => 36,  106 => 35,  100 => 32,  97 => 31,  95 => 30,  92 => 29,  85 => 26,  78 => 23,  76 => 22,  73 => 21,  69 => 20,  59 => 13,  55 => 12,  48 => 8,  42 => 4,  40 => 3,  37 => 2,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/sitefiles/themes/diia/partials/site/sections/newsLast.htm", "");
    }
}
