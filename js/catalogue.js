/**
 * Product Catalogue Interactive Engine
 * Handles dynamic hierarchy navigation, instant category tab switching,
 * live searching, sorting, and browser history synchronization.
 */

(function () {
    'use strict';

    var currentBrandSlug = (window.INITIAL_BRAND || 'delta').toLowerCase();
    var currentSubcatId = window.INITIAL_SUBCAT || '';
    var currentCatId = window.INITIAL_CAT || '';
    var catalogueData = window.CATALOGUE_TREE || { children: [] };
    var imageMap = window.IMAGE_MAP || { products: {}, categories: {}, default: 'img/catalogue/automation-placeholder.svg' };



    // Helper: Find Brand in Tree
    function getBrandNode(slug) {
        if (!catalogueData.children) return null;
        for (var i = 0; i < catalogueData.children.length; i++) {
            var b = catalogueData.children[i];
            var bSlug = b.id.toLowerCase().replace('brand_', '');
            if (bSlug === slug.toLowerCase() || b.name.toLowerCase() === slug.toLowerCase()) {
                return b;
            }
        }
        return null;
    }

    // Helper: Find Subcategory in Brand
    function getSubcatNode(brandNode, subcatId) {
        if (!brandNode || !brandNode.children || !subcatId) return null;
        for (var i = 0; i < brandNode.children.length; i++) {
            var sub = brandNode.children[i];
            if (sub.id.toLowerCase() === subcatId.toLowerCase()) {
                return sub;
            }
        }
        return null;
    }

    // Helper: Count products under a subcategory node
    function countSubcatProducts(subNode) {
        if (!subNode || !subNode.children) return 0;
        var total = 0;
        for (var i = 0; i < subNode.children.length; i++) {
            var cat = subNode.children[i];
            total += (cat.products ? cat.products.length : 0);
        }
        return total;
    }

    // Helper: Count all products under an entire brand
    function countBrandProducts(brandNode) {
        if (!brandNode || !brandNode.children) return 0;
        var total = 0;
        for (var i = 0; i < brandNode.children.length; i++) {
            total += countSubcatProducts(brandNode.children[i]);
        }
        return total;
    }

    // Helper: Get Product Image
    function getProductImage(productId, catId) {
        if (imageMap.products && imageMap.products[productId]) {
            return imageMap.products[productId];
        }
        if (catId && imageMap.categories && imageMap.categories[catId]) {
            return imageMap.categories[catId];
        }
        return imageMap.default || 'img/catalogue/automation-placeholder.svg';
    }

    // Switch Brand (DELTA, INVT, MULTISPAN, LEUZE)
    window.switchBrand = function (brandSlug, skipPushState) {
        currentBrandSlug = brandSlug.toLowerCase();

        // Update brand button active states
        var brandBtns = document.querySelectorAll('.brand-pill-btn');
        brandBtns.forEach(function (btn) {
            if (btn.getAttribute('data-brand-slug') === currentBrandSlug) {
                btn.classList.add('active');
            } else {
                btn.classList.remove('active');
            }
        });

        // Update Breadcrumb active text
        var breadcrumbActive = document.getElementById('breadcrumbActiveBrand');
        var brandNode = getBrandNode(currentBrandSlug);
        var brandDisplayName = brandNode ? brandNode.name : currentBrandSlug.toUpperCase();
        if (breadcrumbActive) {
            breadcrumbActive.textContent = brandDisplayName;
        }

        // Check if brand has subcategories in source JSON
        var hasSubcategories = (brandNode && brandNode.children && brandNode.children.length > 0);

        var detailView = document.getElementById('brandDetailView');
        var showcaseView = document.getElementById('brandShowcaseView');

        if (!hasSubcategories) {
            // MULTISPAN or LEUZE showcase
            if (detailView) detailView.style.display = 'none';
            if (showcaseView) {
                showcaseView.style.display = 'block';
                updateShowcaseContent(currentBrandSlug);
            }

            if (!skipPushState) {
                var newUrl = 'products.php?brand=' + encodeURIComponent(currentBrandSlug);
                window.history.pushState({ brand: currentBrandSlug }, '', newUrl);
            }
            return;
        }

        // DELTA or INVT detail catalogue view
        if (showcaseView) showcaseView.style.display = 'none';
        if (detailView) detailView.style.display = 'block';

        var brandTitleText = document.getElementById('brandTitleText');
        if (brandTitleText) {
            brandTitleText.textContent = brandDisplayName;
        }

        // Render clean Category Tabs directly under brand
        renderCategoryTabs(brandNode);

        // Check if currentSubcatId belongs to this brand; if not, reset to ''
        if (currentSubcatId && !getSubcatNode(brandNode, currentSubcatId)) {
            currentSubcatId = '';
        }
        currentCatId = '';

        // Populate Series dropdown
        populateSeriesDropdown(brandNode, currentSubcatId);

        // Reset search input
        var searchInput = document.getElementById('catalogueSearchInput');
        if (searchInput) searchInput.value = '';

        // Apply filters & render product grid
        applyFilters();

        if (!skipPushState) {
            var url = 'products.php?brand=' + encodeURIComponent(currentBrandSlug);
            if (currentSubcatId) {
                url += '&subcat=' + encodeURIComponent(currentSubcatId);
            }
            window.history.pushState({ brand: currentBrandSlug, subcat: currentSubcatId }, '', url);
        }
    };

    // Helper: Industrial Icon for Subcategories
    function getSubcategoryIcon(name) {
        var lower = (name || '').toLowerCase();
        if (lower.indexOf('plc') !== -1 || lower.indexOf('programmable logic') !== -1) return 'fa-microchip';
        if (lower.indexOf('hmi') !== -1 || lower.indexOf('touch') !== -1 || lower.indexOf('screen') !== -1) return 'fa-display';
        if (lower.indexOf('vfd') !== -1 || lower.indexOf('frequency drive') !== -1) return 'fa-wave-pulse';
        if (lower.indexOf('servo') !== -1) return 'fa-gear';
        if (lower.indexOf('scada') !== -1) return 'fa-desktop';
        if (lower.indexOf('motion') !== -1) return 'fa-arrows-split-up-and-left';
        if (lower.indexOf('robot') !== -1) return 'fa-robot';
        if (lower.indexOf('press') !== -1) return 'fa-compress';
        if (lower.indexOf('industrial pc') !== -1 || lower.indexOf('ipc') !== -1) return 'fa-server';
        if (lower.indexOf('mv drive') !== -1) return 'fa-bolt';
        if (lower.indexOf('temperature') !== -1) return 'fa-temperature-half';
        if (lower.indexOf('smps') !== -1 || lower.indexOf('power supply') !== -1) return 'fa-plug';
        if (lower.indexOf('solar') !== -1) return 'fa-solar-panel';
        if (lower.indexOf('sensor') !== -1) return 'fa-eye';
        return 'fa-layer-group';
    }

    // Render Category Side Tabs (Level 2 Subcategories directly under Brand)
    function renderCategoryTabs(brandNode) {
        var tabsContainer = document.getElementById('categorySideTabs') || document.getElementById('categorySeriesTabs');
        if (!tabsContainer || !brandNode || !brandNode.children) return;

        var totalBrandCount = countBrandProducts(brandNode);

        var html = '';
        // "All Products" Side Tab
        var isAllActive = (!currentSubcatId || currentSubcatId === '');
        html += '<button type="button" class="catalogue-side-tab ' + (isAllActive ? 'active' : '') + '" onclick="switchCategoryTab(\'\')">';
        html += '  <span class="side-tab-name"><i class="fa-light fa-grid-2"></i> <span>All Products</span></span>';
        html += '  <span class="side-tab-count">' + totalBrandCount + '</span>';
        html += '</button>';

        // Tabs for each subcategory (PLC, HMI, VFD, Servos, etc.)
        brandNode.children.forEach(function (sub) {
            var count = countSubcatProducts(sub);
            var isAct = (currentSubcatId === sub.id);
            var icon = getSubcategoryIcon(sub.name);
            html += '<button type="button" class="catalogue-side-tab ' + (isAct ? 'active' : '') + '" data-subcat-id="' + escapeHtml(sub.id) + '" onclick="switchCategoryTab(\'' + escapeHtml(sub.id) + '\')">';
            html += '  <span class="side-tab-name"><i class="fa-light ' + icon + '"></i> <span>' + escapeHtml(sub.name) + '</span></span>';
            html += '  <span class="side-tab-count">' + count + '</span>';
            html += '</button>';
        });

        tabsContainer.innerHTML = html;

        var sidebarBrandBadge = document.getElementById('sidebarBrandBadge');
        if (sidebarBrandBadge) {
            sidebarBrandBadge.textContent = brandNode.name;
        }
    }

    // Switch Category Tab (When user clicks any category tab)
    window.switchCategoryTab = function (subcatId, skipPushState) {
        currentSubcatId = subcatId || '';
        currentCatId = ''; // Reset series filter

        var brandNode = getBrandNode(currentBrandSlug);
        if (!brandNode) return;

        // Update active class on side tabs
        var tabs = document.querySelectorAll('.catalogue-side-tab, .category-tab-btn');
        tabs.forEach(function (tab) {
            var subId = tab.getAttribute('data-subcat-id') || '';
            if (currentSubcatId === '' && !subId) {
                tab.classList.add('active');
            } else if (currentSubcatId !== '' && subId === currentSubcatId) {
                tab.classList.add('active');
            } else {
                tab.classList.remove('active');
            }
        });

        // Update Title & Subtitle in Content Header
        var titleElem = document.getElementById('activeSubcatTitle');
        var subtitleElem = document.getElementById('activeSubcatSubtitle');
        if (titleElem) {
            if (currentSubcatId) {
                var subNode = getSubcatNode(brandNode, currentSubcatId);
                var subName = subNode ? subNode.name : '';
                titleElem.innerHTML = '<i class="fa-light fa-boxes-stacked text-primary"></i> ' + escapeHtml(brandNode.name) + ' - ' + escapeHtml(subName);
                if (subtitleElem) {
                    subtitleElem.textContent = 'Showing models in ' + subName + ' (use filters to refine)';
                }
            } else {
                titleElem.innerHTML = '<i class="fa-light fa-boxes-stacked text-primary"></i> <span id="brandTitleText">' + escapeHtml(brandNode.name) + '</span> Catalogue';
                if (subtitleElem) {
                    subtitleElem.textContent = 'Select a category from the left to filter models';
                }
            }
        }

        // Re-populate Series Dropdown based on chosen subcategory
        populateSeriesDropdown(brandNode, currentSubcatId);

        // Reset search input
        var searchInput = document.getElementById('catalogueSearchInput');
        if (searchInput) searchInput.value = '';

        // Apply filters & render products
        applyFilters();

        // Update URL
        if (!skipPushState) {
            var newUrl = 'products.php?brand=' + encodeURIComponent(currentBrandSlug);
            if (currentSubcatId) {
                newUrl += '&subcat=' + encodeURIComponent(currentSubcatId);
            }
            window.history.pushState({ brand: currentBrandSlug, subcat: currentSubcatId }, '', newUrl);
        }
    };

    // Populate Series Dropdown
    function populateSeriesDropdown(brandNode, subcatId) {
        var dropdown = document.getElementById('seriesDropdownFilter');
        if (!dropdown || !brandNode) return;

        var html = '<option value="">All Series / Models</option>';

        if (subcatId) {
            // Populate series for this specific subcategory
            var subNode = getSubcatNode(brandNode, subcatId);
            if (subNode && subNode.children) {
                subNode.children.forEach(function (cat) {
                    var count = cat.products ? cat.products.length : 0;
                    html += '<option value="' + escapeHtml(cat.id) + '">' + escapeHtml(cat.name) + ' (' + count + ')</option>';
                });
            }
        } else {
            // Populate all series across this brand, grouped by subcategory
            if (brandNode.children) {
                brandNode.children.forEach(function (sub) {
                    if (sub.children && sub.children.length > 0) {
                        html += '<optgroup label="' + escapeHtml(sub.name) + '">';
                        sub.children.forEach(function (cat) {
                            var count = cat.products ? cat.products.length : 0;
                            html += '<option value="' + escapeHtml(cat.id) + '">' + escapeHtml(cat.name) + ' (' + count + ')</option>';
                        });
                        html += '</optgroup>';
                    }
                });
            }
        }

        dropdown.innerHTML = html;
        dropdown.value = currentCatId;
    }

    // Series Dropdown Change
    window.onSeriesDropdownChange = function (catId) {
        currentCatId = catId || '';
        applyFilters();

        var newUrl = 'products.php?brand=' + encodeURIComponent(currentBrandSlug);
        if (currentSubcatId) {
            newUrl += '&subcat=' + encodeURIComponent(currentSubcatId);
        }
        if (currentCatId) {
            newUrl += '&cat=' + encodeURIComponent(currentCatId);
        }
        window.history.pushState({ brand: currentBrandSlug, subcat: currentSubcatId, cat: currentCatId }, '', newUrl);
    };

    // Apply Live Filters & Render Product Grid
    window.applyFilters = function () {
        var brandNode = getBrandNode(currentBrandSlug);
        if (!brandNode) return;

        var searchVal = (document.getElementById('catalogueSearchInput') ? document.getElementById('catalogueSearchInput').value : '').toLowerCase().trim();
        var sortVal = document.getElementById('sortDropdownFilter') ? document.getElementById('sortDropdownFilter').value : 'name_asc';

        // Collect matching subcategories
        var subcategoriesToScan = [];
        if (currentSubcatId) {
            var matchedSub = getSubcatNode(brandNode, currentSubcatId);
            if (matchedSub) subcategoriesToScan.push(matchedSub);
        } else if (brandNode.children) {
            subcategoriesToScan = brandNode.children;
        }

        // Count total products in this scope
        var totalInScope = 0;
        subcategoriesToScan.forEach(function (sub) {
            totalInScope += countSubcatProducts(sub);
        });

        // Gather products
        var productList = [];
        subcategoriesToScan.forEach(function (sub) {
            if (!sub.children) return;
            sub.children.forEach(function (cat) {
                // If a series is selected, only match that series
                if (currentCatId && currentCatId !== cat.id) {
                    return;
                }

                if (cat.products) {
                    cat.products.forEach(function (p) {
                        var nameMatch = p.name.toLowerCase().indexOf(searchVal) !== -1;
                        var baseMatch = (p.base_name || '').toLowerCase().indexOf(searchVal) !== -1;
                        var catNameMatch = cat.name.toLowerCase().indexOf(searchVal) !== -1;
                        var subNameMatch = sub.name.toLowerCase().indexOf(searchVal) !== -1;

                        if (searchVal === '' || nameMatch || baseMatch || catNameMatch || subNameMatch) {
                            productList.push({
                                product: p,
                                category: cat,
                                subcategory: sub,
                                brand: brandNode
                            });
                        }
                    });
                }
            });
        });

        // Sort products
        productList.sort(function (a, b) {
            var nameA = a.product.name.toLowerCase();
            var nameB = b.product.name.toLowerCase();
            if (sortVal === 'name_desc') {
                return nameB.localeCompare(nameA);
            }
            return nameA.localeCompare(nameB);
        });

        // Update Live Product Counter
        var counterBadge = document.getElementById('productCounterBadge');
        if (counterBadge) {
            counterBadge.innerHTML = '<i class="fa-light fa-boxes-stacked"></i> Showing <strong>' + productList.length + '</strong> of ' + totalInScope + ' products';
        }

        // Render Cards
        renderProductCards(productList);
    };

    // Render Product Cards (Reusable Card Template)
    function renderProductCards(items) {
        var grid = document.getElementById('catalogueProductGrid');
        var emptyState = document.getElementById('noProductsFoundState');
        if (!grid) return;

        if (items.length === 0) {
            grid.innerHTML = '';
            if (emptyState) emptyState.classList.remove('d-none');
            return;
        }

        if (emptyState) emptyState.classList.add('d-none');

        var html = '';
        items.forEach(function (item) {
            var p = item.product;
            var cat = item.category;
            var sub = item.subcategory;
            var brand = item.brand;
            var img = getProductImage(p.id, cat.id);

            html += '<div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">';
            html += '  <div class="catalogue-product-card">';
            html += '    <a href="product-detail.php?id=' + encodeURIComponent(p.id) + '" class="card-thumb">';
            html += '      <img src="' + escapeHtml(img) + '" alt="' + escapeHtml(p.name) + '" loading="lazy">';
            html += '      <span class="card-brand-badge">' + escapeHtml(brand.name) + '</span>';
            html += '    </a>';
            html += '    <div class="card-body">';
            html += '      <div class="card-meta-tags">';
            html += '        <span class="card-subcat-tag">' + escapeHtml(sub.name) + '</span>';
            html += '      </div>';
            html += '      <span class="card-series-name">' + escapeHtml(cat.name) + '</span>';
            html += '      <h4 class="card-title">';
            html += '        <a href="product-detail.php?id=' + encodeURIComponent(p.id) + '">' + escapeHtml(p.name) + '</a>';
            html += '      </h4>';
            html += '      <div class="card-footer-action">';
            html += '        <a href="product-detail.php?id=' + encodeURIComponent(p.id) + '" class="btn-view-detail">View Details <i class="fa-light fa-arrow-right"></i></a>';
            html += '        <button type="button" class="btn-card-enquire" data-bs-toggle="modal" data-bs-target="#enquireModal" data-product="' + escapeHtml(p.name) + '" title="Quick Enquiry">';
            html += '          <i class="fa-light fa-envelope"></i>';
            html += '        </button>';
            html += '      </div>';
            html += '    </div>';
            html += '  </div>';
            html += '</div>';
        });

        grid.innerHTML = html;
        attachEnquireListeners();
    }

    // Reset Filters
    window.resetFilters = function () {
        currentCatId = '';
        var searchInput = document.getElementById('catalogueSearchInput');
        if (searchInput) searchInput.value = '';

        var seriesDropdown = document.getElementById('seriesDropdownFilter');
        if (seriesDropdown) seriesDropdown.value = '';

        var sortDropdown = document.getElementById('sortDropdownFilter');
        if (sortDropdown) sortDropdown.value = 'name_asc';

        applyFilters();

        var newUrl = 'products.php?brand=' + encodeURIComponent(currentBrandSlug);
        if (currentSubcatId) {
            newUrl += '&subcat=' + encodeURIComponent(currentSubcatId);
        }
        window.history.pushState({ brand: currentBrandSlug, subcat: currentSubcatId }, '', newUrl);
    };

    // Update View for Brands without subcategories (MULTISPAN & LEUZE)
    function updateShowcaseContent(brandSlug) {
        var brandNode = getBrandNode(brandSlug);
        var brandName = brandNode ? brandNode.name : brandSlug.toUpperCase();

        var badge = document.getElementById('showcaseBadge');
        var title = document.getElementById('showcaseTitle');
        var desc = document.getElementById('showcaseDescription');
        var btn = document.getElementById('showcaseEnquireBtn');

        if (badge) badge.textContent = brandName;
        if (title) title.textContent = 'No Content Available';
        if (desc) {
            desc.textContent = 'Products and categories for ' + brandName + ' are currently not listed in this catalogue. For inquiries regarding ' + brandName + ' models and solutions, please contact our team.';
        }
        if (btn) {
            btn.innerHTML = 'Enquire for ' + brandName + ' <i class="fa-light fa-bolt"></i>';
            btn.setAttribute('data-product', brandName);
        }

        attachEnquireListeners();
    }

    // Modal Pre-fill for Enquire Buttons
    function attachEnquireListeners() {
        document.querySelectorAll('[data-bs-target="#enquireModal"]').forEach(function (btn) {
            btn.onclick = function () {
                var prodName = this.getAttribute('data-product');
                if (prodName) {
                    var messageInput = document.querySelector('#enquireModal textarea[name="message"]');
                    if (messageInput) {
                        messageInput.value = 'Inquiry for ' + prodName + ': Please provide technical specifications and quotation.';
                    }
                    var interestSelect = document.querySelector('#enquireModal select[name="interest"]');
                    if (interestSelect) {
                        interestSelect.value = 'Industrial Products';
                    }
                }
            };
        });

        var modalEl = document.getElementById('enquireModal');
        if (modalEl && !modalEl.__listenerAttached) {
            modalEl.__listenerAttached = true;
            modalEl.addEventListener('show.bs.modal', function (event) {
                var triggerBtn = event.relatedTarget;
                if (!triggerBtn) return;
                var prodName = triggerBtn.getAttribute('data-product');
                if (prodName) {
                    var messageInput = modalEl.querySelector('textarea[name="message"]');
                    if (messageInput) {
                        messageInput.value = 'Inquiry for ' + prodName + ': Please provide technical specifications and quotation.';
                    }
                    var interestSelect = modalEl.querySelector('select[name="interest"]');
                    if (interestSelect) {
                        interestSelect.value = 'Industrial Products';
                    }
                }
            });
        }
    }

    // Utility: HTML Escape
    function escapeHtml(str) {
        if (!str) return '';
        return String(str)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }

    // Handle Browser Back/Forward buttons (popstate)
    window.addEventListener('popstate', function () {
        var params = new URLSearchParams(window.location.search);
        var brand = (params.get('brand') || 'delta').toLowerCase();
        var subcat = params.get('subcat') || '';
        var cat = params.get('cat') || '';

        currentBrandSlug = brand;
        currentSubcatId = subcat;
        currentCatId = cat;

        switchBrand(brand, true);
        if (subcat) {
            switchCategoryTab(subcat, true);
            if (cat) {
                var dropdown = document.getElementById('seriesDropdownFilter');
                if (dropdown) dropdown.value = cat;
                currentCatId = cat;
                applyFilters();
            }
        }
    });

    // Initial DOM Ready Boot
    document.addEventListener('DOMContentLoaded', function () {
        var brandNode = getBrandNode(currentBrandSlug);
        var hasSubcategories = (brandNode && brandNode.children && brandNode.children.length > 0);

        if (hasSubcategories) {
            renderCategoryTabs(brandNode);
            populateSeriesDropdown(brandNode, currentSubcatId);
            if (currentCatId) {
                var dropdown = document.getElementById('seriesDropdownFilter');
                if (dropdown) dropdown.value = currentCatId;
            }
            applyFilters();
        } else {
            updateShowcaseContent(currentBrandSlug);
        }

        attachEnquireListeners();
    });

})();
