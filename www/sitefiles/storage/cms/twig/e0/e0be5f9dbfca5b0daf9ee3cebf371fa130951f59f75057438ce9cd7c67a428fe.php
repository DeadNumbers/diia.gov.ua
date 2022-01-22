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

/* /var/www/sitefiles/themes/diia/partials/site/sections/inlinerender/serviceInfoBlocks.htm */
class __TwigTemplate_326add8f8d8847e2d84592473c89c5b7e63a610eb8638017a88760fd16d790cc extends \Twig\Template
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
        echo "<style>
@font-face {
    font-family: 'e-ukraine';
    src: url(";
        // line 4
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/fonts/e-Ukraine-new/e-Ukraine-Regular.ttf");
        echo ") format(\"truetype\");
}

#test-fop_print-pdf *:empty {
    display: none !important;
}

#test-fop_print-pdf * {
    font-family: 'e-ukraine' !important;
    font-weight: 400 !important;
    line-height: normal !important;
    font-size: 16px !important;
}

#test-fop_print-pdf .service-acc_simple,
#test-fop_print-pdf .service-acc_simple-text,
#test-fop_print-pdf .service-acc_big-title,
#test-fop_print-pdf .service-acc_big,
#test-fop_print-pdf .service-acc_item,
#test-fop_print-pdf .service-acc_big-inner,
#test-fop_print-pdf .service-acc_section {
    margin: 0 !important;
}

#test-fop_print-pdf .service-acc_item-quest {
    font-size: 30px !important;
    line-height: 36px !important;
    margin: 0 !important;
    padding: 0 !important;
}

#test-fop_print-pdf .test-fop_result-info {
    border: 2px solid #000 !important;
    padding: 0 10px 0 20px !important;
}

#test-fop_print-pdf .test-fop_result .h5 {
    margin: 10px 0 20px !important;
}

/* display: NONE */
#test-fop_print-pdf a .icon,
#test-fop_print-pdf .embed-responsive,
#test-fop_print-pdf iframe,
#test-fop_print-pdf br,
#test-fop_print-pdf [data-empty~=true],
#test-fop_print-pdf *:before,
#test-fop_print-pdf *:after,
#test-fop_print-pdf table,
#test-fop_print-pdf .fr-fic,
#test-fop_print-pdf .fr-dii {
    display: none !important
}

/* display: NONE */
#test-fop_print-pdf h1,
#test-fop_print-pdf .h1,
#test-fop_print-pdf h2,
#test-fop_print-pdf .h2,
#test-fop_print-pdf .h2-3,
#test-fop_print-pdf h3,
#test-fop_print-pdf .h3,
#test-fop_print-pdf h4,
#test-fop_print-pdf h5,
#test-fop_print-pdf h6,
#test-fop_print-pdf .h4,
#test-fop_print-pdf .h5,
#test-fop_print-pdf .h6 {
    margin-top: 30px !important;
    margin-bottom: 20px !important;
    font-weight: 400 !important;
    color: #000 !important;
}

#test-fop_print-pdf h1,
#test-fop_print-pdf .h1 {
    font-size: 32px !important;
}


#test-fop_print-pdf h2,
#test-fop_print-pdf .h2 {
    font-size: 28px !important;
}

#test-fop_print-pdf h3,
#test-fop_print-pdf .h3 {
    font-size: 24px !important;
}

#test-fop_print-pdf h4,
#test-fop_print-pdf h5,
#test-fop_print-pdf h6,
#test-fop_print-pdf .h4,
#test-fop_print-pdf .h5,
#test-fop_print-pdf .h6 {
    font-size: 20px !important;
}

#test-fop_print-pdf p {}

#test-fop_print-pdf p a,
#test-fop_print-pdf p span {
    font-size: inherit !important;
    font-family: \"e-ukraine\" !important;
    line-height: inherit !important;
    font-weight: inherit !important
}

#test-fop_print-pdf p strong {
    font-size: inherit !important;
    font-family: \"e-ukraine\" !important;
    line-height: inherit !important
}

#test-fop_print-pdf p img {
    display: block;
    width: auto !important;
    max-width: 100% !important;
    margin-bottom: 15px;
    margin-left: auto !important;
    margin-right: auto !important
}

#test-fop_print-pdf pre {
    display: inline-block !important;
    margin-bottom: 15px !important;
    border: 0 !important;
    background-color: transparent !important
}

#test-fop_print-pdf pre:first-child {
    float: left !important;
    margin-bottom: 0 !important
}

#test-fop_print-pdf pre:last-child {
    float: right;
    text-transform: uppercase;
    margin-right: 70px;
    margin-bottom: 0
}

#test-fop_print-pdf div p {
    margin-bottom: 15px !important
}

#test-fop_print-pdf img {
    margin: 15px 0 20px !important;
    display: block !important;
    max-width: 100% !important
}

#test-fop_print-pdf a {
    font-size: inherit !important;
    font-family: \"e-ukraine\" !important;
    line-height: inherit !important;
    font-weight: inherit !important;
    transition: .2s ease-in-out !important;
    border: none !important;
    text-decoration: underline !important;
    color: #000 !important
}

#test-fop_print-pdf .not-blockquote {
    padding: 10px 20px !important;
    margin: 0 0 20px !important;
    border-left: 5px solid #eee !important
}

#test-fop_print-pdf blockquote:not(.not-blockquote) {
    display: block !important;
    margin: 40px 0 !important;
    max-width: 700px !important;
    position: relative !important;
    color: #000 !important;
    font-family: \"e-ukraine\" !important;
    font-size: 20px !important;
    line-height: 30px !important;
    padding: 0 25px !important
}

#test-fop_print-pdf blockquote:not(.not-blockquote) p {
    margin: 0 !important
}

#test-fop_print-pdf small {
    font-size: 16px !important;
}

#test-fop_print-pdf a[target] {
    padding-right: 0 !important;
    position: relative !important;
    display: inline !important;
}

#test-fop_print-pdf a[target] span {
    position: relative !important;
    transition: .3s ease-in-out !important
}

#test-fop_print-pdf>*:first-child {
    margin-top: 0 !important
}

/* 
* {
    -webkit-print-color-adjust: economy;
    print-color-adjust: economy
}
    
@page {
    margin: 1.5cm
} 
*/

#test-fop_print-pdf *,
#test-fop_print-pdf p,
#test-fop_print-pdf div {
    margin: 10px 0 !important;
}

#test-fop_print-pdf span,
#test-fop_print-pdf b,
#test-fop_print-pdf strong,
#test-fop_print-pdf a {
    margin: 0 !important
}

#test-fop_print-pdf ol,
#test-fop_print-pdf ul {
    margin: 0 !important;
}

#test-fop_print-pdf ol li ol li,
#test-fop_print-pdf ol li ul li,
#test-fop_print-pdf ul li ol li,
#test-fop_print-pdf ul li ul li {
    font-size: 16px !important;
} 

#test-fop_print-pdf .service-acc_big {
    padding: 5px !important;
    margin: 0 !important;
}

#test-fop_print-pdf .service-acc_big-inner {
    padding: 10px 20px !important;
    margin: 0 !important;
    border: 2px solid #000 !important;
}

</style>
<div id=\"test-fop_print-pdf\">
    <div class=\"service-acc_section\">
        ";
        // line 259
        if (twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "title", [], "any", false, false, false, 259)) {
            // line 260
            echo "        <div class=\"service-acc_item-quest\">
            ";
            // line 261
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "title", [], "any", false, false, false, 261), "html", null, true);
            echo "
        </div>
        ";
        }
        // line 264
        echo "        <div class=\"collapse service-acc_simple-answer\">
            <div class=\"row\">
                ";
        // line 266
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "items", [], "any", false, false, false, 266));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 267
            echo "                    ";
            if (twig_get_attribute($this->env, $this->source, $context["item"], "label", [], "any", false, false, false, 267)) {
                // line 268
                echo "                        <div class=\"col-12 h5\">";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "label", [], "any", false, false, false, 268), "html", null, true);
                echo "</div>
                    ";
            }
            // line 270
            echo "                    ";
            $context['__cms_partial_params'] = [];
            $context['__cms_partial_params']['items'] = twig_slice($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "items", [], "any", false, false, false, 270), 0, twig_round((twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "items", [], "any", false, false, false, 270)) / 2)))            ;
            echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("site/sections/serviceInfoBlocks/items"            , $context['__cms_partial_params']            , true            );
            unset($context['__cms_partial_params']);
            // line 271
            echo "                    ";
            $context['__cms_partial_params'] = [];
            $context['__cms_partial_params']['items'] = twig_slice($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "items", [], "any", false, false, false, 271), twig_round((twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "items", [], "any", false, false, false, 271)) / 2)))            ;
            echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("site/sections/serviceInfoBlocks/items"            , $context['__cms_partial_params']            , true            );
            unset($context['__cms_partial_params']);
            // line 272
            echo "                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 273
        echo "            </div>
        </div>
    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "/var/www/sitefiles/themes/diia/partials/site/sections/inlinerender/serviceInfoBlocks.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  346 => 273,  340 => 272,  334 => 271,  328 => 270,  322 => 268,  319 => 267,  315 => 266,  311 => 264,  305 => 261,  302 => 260,  300 => 259,  42 => 4,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/sitefiles/themes/diia/partials/site/sections/inlinerender/serviceInfoBlocks.htm", "");
    }
}
