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

/* /var/www/sitefiles/themes/diia/partials/site/sections/mailrender/serviceInfoBlocks.htm */
class __TwigTemplate_458963111cbc1bb309e2650b13b439e622c11ebd2dd6b073b41875f1b0d3c104 extends \Twig\Template
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
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "items", [], "any", false, false, false, 1));
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
            // line 2
            echo "    ";
            $context["loopLast"] = twig_get_attribute($this->env, $this->source, $context["loop"], "last", [], "any", false, false, false, 2);
            // line 3
            echo "
    <!-- horizontal line -->
    ";
            // line 5
            if (( !twig_get_attribute($this->env, $this->source, $context["loop"], "first", [], "any", false, false, false, 5) &&  !twig_get_attribute($this->env, $this->source, $context["item"], "email_custom_style", [], "any", false, false, false, 5))) {
                // line 6
                echo "        <tr>
            <td sorder=\"0\" tyle=\"border: none;\">
                <table class=\"tableInner\" width=\"640\" bgcolor=\"#fff\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" style='padding-top: 0px; padding-right: 50px; padding-left: 50px; padding-bottom: 0px;margin: 0 auto;' align=\"center\">
                    <tbody>
                        <tr>
                            <td style=\"border: none !important;padding-bottom: 20px;\" border=\"0\" width=\"640\">
                                <p style=\"height: 1px; background-color: #d6e2e2; padding:0; margin: 0;\"></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    ";
            }
            // line 20
            echo "    <!-- END horizontal line -->

    ";
            // line 22
            if (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "items", [], "any", false, false, false, 22))) {
                // line 23
                echo "        ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["item"], "items", [], "any", false, false, false, 23));
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
                foreach ($context['_seq'] as $context["_key"] => $context["_item"]) {
                    // line 24
                    echo "            <tr>
                <td border=\"0\" style=\"border: none;\">
                    ";
                    // line 26
                    if ( !twig_get_attribute($this->env, $this->source, $context["item"], "email_custom_style", [], "any", false, false, false, 26)) {
                        // line 27
                        echo "                         <table class=\"tableInner\" bgcolor=\"#fff\" width=\"640\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" style='padding-top: 0px; padding-right: 50px; padding-left: 50px; padding-bottom: 0px; margin: 0 auto;' align=\"center\">
                            <tbody>
                                ";
                        // line 29
                        if (twig_get_attribute($this->env, $this->source, $context["loop"], "first", [], "any", false, false, false, 29)) {
                            // line 30
                            echo "                                    <tr>
                                        <td style=\"color: #000;font-family: 'Open-Sans', Arial, Helvetica, sans-serif; font-size: 21px;font-weight: bold;line-height: 26px;letter-spacing: -0.02em; margin: 0;padding-bottom: 20px;\" class=\"title-item\" width=\"640\" max-width=\"640px\" align=\"left\">
                                            💻 ";
                            // line 32
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "label", [], "any", false, false, false, 32), "html", null, true);
                            echo "
                                        </td>
                                    </tr>
                                ";
                        }
                        // line 36
                        echo "                                <tr>
                                    <td style='font-size: 16px;line-height: 20px;color: #000;font-family: \"Open-Sans\", Arial, Helvetica, sans-serif;padding-bottom: 0px;letter-spacing: -0.02em;' class=\"editor-item\" width=\"640\" max-width=\"640px\" align=\"left\">
                                        ";
                        // line 38
                        echo twig_get_attribute($this->env, $this->source, $context["_item"], "text", [], "any", false, false, false, 38);
                        echo "
                                    </td>
                                </tr>
                                ";
                        // line 41
                        if (twig_get_attribute($this->env, $this->source, KitSoft\Pages\Twig\Filters::relationFinder(twig_get_attribute($this->env, $this->source, $context["_item"], "link", [], "any", false, false, false, 41)), "title", [], "any", false, false, false, 41)) {
                            // line 42
                            echo "                                    <tr>
                                        <td width=\"640\" max-width=\"640px\" align=\"left\" style=\"padding-bottom: 20px;\"> 
                                            <a style='text-decoration:none;background-color:#000;padding:16px 44px;color:#FFFFFF;box-shadow:none;margin-right:4px;border-radius:40px;background-color:#000;font-size:16px;margin-top:40px;display:inline-block;font-family: \"Open-Sans\", Arial,Helvetica, sans-serif; text-align: center;' target='_blank' href='";
                            // line 44
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, KitSoft\Pages\Twig\Filters::relationFinder(twig_get_attribute($this->env, $this->source, $context["_item"], "link", [], "any", false, false, false, 44)), "url", [], "any", false, false, false, 44), "html", null, true);
                            echo "' class=\"btn-default\">
                                                ";
                            // line 45
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, KitSoft\Pages\Twig\Filters::relationFinder(twig_get_attribute($this->env, $this->source, $context["_item"], "link", [], "any", false, false, false, 45)), "title", [], "any", false, false, false, 45), "html", null, true);
                            echo "
                                            </a>
                                        </td>
                                    </tr>
                                ";
                        }
                        // line 50
                        echo "                            </tbody>
                        </table>
                    ";
                    } else {
                        // line 53
                        echo "                        <table class=\"tableInner\" width=\"640\" bgcolor=\"#99cbfe\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" style='padding-top: 0px; padding-right: 50px; padding-left: 50px; padding-bottom: 0px; margin: 0 auto;' align=\"center\">
                            <tbody>
                                ";
                        // line 55
                        if (twig_get_attribute($this->env, $this->source, $context["loop"], "first", [], "any", false, false, false, 55)) {
                            // line 56
                            echo "                                    <tr>
                                        <td style='font-family: \"Open-Sans\", Arial, Helvetica, sans-serif;font-size: 21px;font-weight: bold;line-height: 26px;padding-bottom: 20px;letter-spacing: -0.02em;background-color: #99cbfe; padding-top: 20px;' class=\"title-item\" width=\"640\" max-width=\"640px\" align=\"left\">
                                            ☝️ ";
                            // line 58
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "label", [], "any", false, false, false, 58), "html", null, true);
                            echo "
                                        </td>
                                    </tr>
                                ";
                        }
                        // line 62
                        echo "                                <tr>
                                    <td style='font-family: \"Open-Sans\", Arial, Helvetica, sans-serif;font-size: 16px;line-height: 20px;color: #000;padding-bottom: 0px;margin-top: 0;margin-bottom: 0;font-size: 15px; padding-top: 0;' class=\"editor-item\" width=\"640\" max-width=\"640px\" align=\"left\">
                                            ";
                        // line 64
                        echo twig_get_attribute($this->env, $this->source, $context["_item"], "text", [], "any", false, false, false, 64);
                        echo "
                                    </td>
                                </tr>
                                ";
                        // line 67
                        if (twig_get_attribute($this->env, $this->source, KitSoft\Pages\Twig\Filters::relationFinder(twig_get_attribute($this->env, $this->source, $context["_item"], "link", [], "any", false, false, false, 67)), "title", [], "any", false, false, false, 67)) {
                            // line 68
                            echo "                                    <tr>
                                        <td width=\"640\" max-width=\"640px\" align=\"left\" style=\"padding-bottom: 20px;\"> 
                                            <a style='font-family: \"Open-Sans\", Arial, Helvetica, sans-serif;text-decoration:none;background-color:#000;padding:16px 44px;box-shadow:none;margin-right:4px;border-radius:40px;background-color:#000000;font-size:16px;margin-top:0px;display:inline-block; text-align: center;' target='_blank' href='";
                            // line 70
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, KitSoft\Pages\Twig\Filters::relationFinder(twig_get_attribute($this->env, $this->source, $context["_item"], "link", [], "any", false, false, false, 70)), "url", [], "any", false, false, false, 70), "html", null, true);
                            echo "' class=\"btn-default\">
                                                    ";
                            // line 71
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, KitSoft\Pages\Twig\Filters::relationFinder(twig_get_attribute($this->env, $this->source, $context["_item"], "link", [], "any", false, false, false, 71)), "title", [], "any", false, false, false, 71), "html", null, true);
                            echo "
                                            </a>
                                        </td>
                                    </tr>
                                ";
                        }
                        // line 76
                        echo "                            </tbody>
                        </table>
                    ";
                    }
                    // line 79
                    echo "                </td>
            </tr>
        ";
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
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['_item'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 82
                echo "    ";
            }
            // line 83
            echo "
    ";
            // line 84
            if (($context["loopLast"] ?? null)) {
                // line 85
                echo "    <tr>
        <td width=\"640\" border=\"0\" style=\"border: none;\">
            <table width=\"640\" bgcolor=\"#fff\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" style='padding: 0px;margin: 0 auto;' align=\"center\">
                <tbody>
                    <td width=\"640\" style=\"height: 20px;padding-top: 20px;padding-bottom: 20px;\"></td>
                </tbody>
            </table>
        </td>
    </tr>
    ";
            }
            // line 95
            echo "
";
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
    }

    public function getTemplateName()
    {
        return "/var/www/sitefiles/themes/diia/partials/site/sections/mailrender/serviceInfoBlocks.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  245 => 95,  233 => 85,  231 => 84,  228 => 83,  225 => 82,  209 => 79,  204 => 76,  196 => 71,  192 => 70,  188 => 68,  186 => 67,  180 => 64,  176 => 62,  169 => 58,  165 => 56,  163 => 55,  159 => 53,  154 => 50,  146 => 45,  142 => 44,  138 => 42,  136 => 41,  130 => 38,  126 => 36,  119 => 32,  115 => 30,  113 => 29,  109 => 27,  107 => 26,  103 => 24,  85 => 23,  83 => 22,  79 => 20,  63 => 6,  61 => 5,  57 => 3,  54 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/sitefiles/themes/diia/partials/site/sections/mailrender/serviceInfoBlocks.htm", "");
    }
}
