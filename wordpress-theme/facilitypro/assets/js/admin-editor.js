/**
 * FacilityPro Gutenberg Block Editor Canvas Enhancer
 * Injects Tailwind CSS, Theme Styles, and Lucide Icons directly into the Block Editor iframe
 */
(function() {
    'use strict';

    function injectStylesAndScriptsIntoDocument(doc, win) {
        if (!doc || !doc.head) return;
        if (doc.getElementById('facilitypro-gutenberg-injected')) return;

        var marker = doc.createElement('meta');
        marker.id = 'facilitypro-gutenberg-injected';
        doc.head.appendChild(marker);

        // 1. Google Fonts
        var fontLink = doc.createElement('link');
        fontLink.rel = 'stylesheet';
        fontLink.href = 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@500;600;700;800&family=JetBrains+Mono:wght@400;600&display=swap';
        doc.head.appendChild(fontLink);

        // 2. Tailwind CDN
        var twScript = doc.createElement('script');
        twScript.src = 'https://cdn.tailwindcss.com';
        doc.head.appendChild(twScript);

        // 3. Theme Stylesheet
        var themeCss = doc.createElement('link');
        themeCss.rel = 'stylesheet';
        var themeUri = (window.facilityProEditorData && window.facilityProEditorData.themeUri) ? window.facilityProEditorData.themeUri : '/wp-content/themes/facilitypro';
        themeCss.href = themeUri + '/assets/css/facilitypro.css';
        doc.head.appendChild(themeCss);

        // 4. Lucide Icons
        var lucideScript = doc.createElement('script');
        lucideScript.src = 'https://unpkg.com/lucide@latest';
        lucideScript.onload = function() {
            if (win && win.lucide) {
                win.lucide.createIcons();
            }
        };
        doc.head.appendChild(lucideScript);

        // 5. Canvas wrapper styling
        var canvasStyle = doc.createElement('style');
        canvasStyle.textContent = `
            body.editor-styles-wrapper {
                font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif !important;
                background-color: #f8fafc !important;
                color: #1e293b !important;
                padding: 0 !important;
            }
            .wp-block {
                max-width: 100% !important;
            }
            .block-editor-block-list__layout {
                padding: 0 !important;
            }
        `;
        doc.head.appendChild(canvasStyle);

        // Periodic Lucide icon renderer for dynamically added blocks
        setInterval(function() {
            if (win && win.lucide) {
                try {
                    win.lucide.createIcons();
                } catch(e) {}
            }
        }, 1500);
    }

    function checkAndInject() {
        // Find Gutenberg editor iframes
        var iframes = document.querySelectorAll('iframe[name="editor-canvas"], iframe.edit-site-visual-editor, .edit-post-visual-editor iframe');
        if (iframes && iframes.length > 0) {
            iframes.forEach(function(iframe) {
                try {
                    if (iframe.contentDocument && iframe.contentDocument.readyState === 'complete') {
                        injectStylesAndScriptsIntoDocument(iframe.contentDocument, iframe.contentWindow);
                    } else if (iframe.contentDocument) {
                        iframe.addEventListener('load', function() {
                            injectStylesAndScriptsIntoDocument(iframe.contentDocument, iframe.contentWindow);
                        });
                    }
                } catch(e) {
                    console.warn('FacilityPro Gutenberg styling injection error:', e);
                }
            });
        } else {
            // Non-iframed fallback
            injectStylesAndScriptsIntoDocument(document, window);
        }
    }

    // Run on DOM ready and continuously check for Gutenberg canvas mounting
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            setInterval(checkAndInject, 500);
        });
    } else {
        setInterval(checkAndInject, 500);
    }
})();
