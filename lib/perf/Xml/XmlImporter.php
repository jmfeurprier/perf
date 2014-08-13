<?php

namespace perf\Xml;

/**
 *
 *
 * @package perf
 */
class XmlImporter
{

    /**
     *
     *
     * @param string $path
     * @return Document
     * @throws \RuntimeException
     */
    public function import($path)
    {
        try {
            $sxe = new \SimpleXMLElement($path, null, true);
        } catch (\Exception $e) {
            throw new \RuntimeException("Failed to load XML document at '{$path}'.", 0, $e);
        }

        $nodes = array();

        foreach ($sxe as $key => $element) {
            $nodes[$key] = $this->toArray($element);
        }

        return new Document($nodes);
    }

    /**
     *
     *
     * @param \SimpleXMLElement $sxe
     * @return string|array
     */
    private function toArray(\SimpleXMLElement $sxe)
    {
        if (count($sxe->children()) < 1) {
            return (string) $sxe;
        }

        $nodes = array();

        foreach ($sxe->children() as $key => $value) {
            $value = (count($value->children()) > 0)
                   ? $this->toArray($value)
                   : (string) $value;

            if (array_key_exists($key, $nodes)) {
                if (!is_array($nodes[$key]) || !array_key_exists(0, $nodes[$key])) {
                    $nodes[$key] = array($nodes[$key]);
                }

                $nodes[$key][] = $value;
            } else {
                $nodes[$key] = $value;
            }
        }

        return $nodes;
    }
}
