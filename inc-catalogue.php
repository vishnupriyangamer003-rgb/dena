<?php
/**
 * Product Catalogue Engine - Single Source of Truth from product_catalogue_hybrid_tree.json
 */

function catalogue_get_tree() {
    static $tree = null;
    if ($tree !== null) {
        return $tree;
    }
    $file = __DIR__ . '/data/product_catalogue_hybrid_tree.json';
    if (!file_exists($file)) {
        return null;
    }
    $json = file_get_contents($file);
    $data = json_decode($json, true);
    $tree = $data['tree'] ?? null;
    return $tree;
}

function catalogue_get_image_map() {
    static $map = null;
    if ($map !== null) {
        return $map;
    }
    $file = __DIR__ . '/data/catalogue_image_map.json';
    if (!file_exists($file)) {
        return [];
    }
    $json = file_get_contents($file);
    $map = json_decode($json, true) ?: [];
    return $map;
}

function catalogue_get_product_image($productId, $catId = '') {
    $map = catalogue_get_image_map();
    if (!empty($map['products'][$productId])) {
        return $map['products'][$productId];
    }
    if (!empty($catId) && !empty($map['categories'][$catId])) {
        return $map['categories'][$catId];
    }
    return $map['default'] ?? 'img/catalogue/automation-placeholder.svg';
}

function catalogue_get_brands() {
    $tree = catalogue_get_tree();
    return $tree['children'] ?? [];
}

function catalogue_find_brand($brandSlugOrId) {
    $brands = catalogue_get_brands();
    $slug = strtolower(trim($brandSlugOrId));
    foreach ($brands as $b) {
        if (strtolower($b['id']) === $slug || strtolower($b['name']) === $slug || strtolower(str_replace('brand_', '', $b['id'])) === $slug) {
            return $b;
        }
    }
    return $brands[0] ?? null;
}

function catalogue_find_subcat($subcatSlugOrId, $brandNode = null) {
    if (!$brandNode) {
        $brands = catalogue_get_brands();
    } else {
        $brands = [$brandNode];
    }
    $slug = strtolower(trim($subcatSlugOrId));
    foreach ($brands as $b) {
        foreach ($b['children'] ?? [] as $sub) {
            if (strtolower($sub['id']) === $slug || strtolower($sub['name']) === $slug) {
                return ['subcat' => $sub, 'brand' => $b];
            }
        }
    }
    return null;
}

function catalogue_find_product($productId) {
    $brands = catalogue_get_brands();
    $searchId = strtolower(trim($productId));
    foreach ($brands as $b) {
        foreach ($b['children'] ?? [] as $sub) {
            foreach ($sub['children'] ?? [] as $cat) {
                foreach ($cat['products'] ?? [] as $p) {
                    if (strtolower($p['id']) === $searchId || strtolower($p['name']) === $searchId) {
                        // Gather related products from same category/series (excluding current)
                        $related = [];
                        foreach ($cat['products'] as $rp) {
                            if (strtolower($rp['id']) !== $searchId) {
                                $related[] = [
                                    'id' => $rp['id'],
                                    'name' => $rp['name'],
                                    'base_name' => $rp['base_name'],
                                    'image' => catalogue_get_product_image($rp['id'], $cat['id'])
                                ];
                            }
                        }
                        return [
                            'product' => $p,
                            'category' => $cat,
                            'subcategory' => $sub,
                            'brand' => $b,
                            'image' => catalogue_get_product_image($p['id'], $cat['id']),
                            'related' => $related
                        ];
                    }
                }
            }
        }
    }
    return null;
}

