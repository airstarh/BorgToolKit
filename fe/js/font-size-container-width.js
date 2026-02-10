(function () {

    //##########
    //region MAIN
    /**
     * Scans classes "js-fit-width" and accommodates font size to fit container.
     * IMPORTANT:
     * CSS width of a container
     * AND
     * CSS font-size of a container
     * ARE TO BE SET. Play with such units as VW, CH, FR
     */
    const fontSizeLimit = 2;
    const fontSizeStep = -2;
    const fontSizeFirstAttribute = 'data-font-size-first';

    function domFitFontSize(event) {

        const itemList = document.getElementsByClassName('js-fit-width')
        for (let i = 0; i < itemList.length; i++) {
            const element = itemList[i];
            const innerText = element.innerText;
            const clientWidth = element.clientWidth;
            const fontFamily = getFontFamily(element)

            //Check if Text goes beyond
            let fontSizeFirst = 0.0;
            if (element.hasAttribute(fontSizeFirstAttribute)) {
                fontSizeFirst = element.getAttribute(fontSizeFirstAttribute);
            } else {
                fontSizeFirst = getFontSize(element);
                element.setAttribute(fontSizeFirstAttribute, fontSizeFirst);
            }
            fontSizeFirst = parseFloat(fontSizeFirst);
            const strWidthFirst = calcWidth(innerText, fontSizeFirst, fontFamily);
            if (strWidthFirst < clientWidth) {
                element.style.fontSize = `${fontSizeFirst}px`;
                continue;
            }

            let fs = fontSizeFirst;
            for (fs; fs >= fontSizeLimit; fs += fontSizeStep) {
                const strWidth = calcWidth(innerText, fs, fontFamily);

                if (strWidth < clientWidth) {
                    element.style.fontSize = `${fs}px`;
                    break;
                }
            }
        }

        return null;
    }

    //endregion MAIN
    //##########
    //region HELPERS

    // Create CANVAS object and retrieve drawing context
    const canvas = document.createElement('canvas');
    const canvasContext = canvas.getContext('2d');

    function calcWidth(str, fontSize, fontFamily) {

        // set FONT SIZE and FONT FAMILY
        canvasContext.font = `${fontSize}px ${fontFamily}`;

        // Measure WIDTH of the ROW
        return canvasContext.measureText(str).width;
    }

    function getFontSize(element) {
        var style = window.getComputedStyle(element, null).getPropertyValue('font-size');
        return parseFloat(style);
    }

    function getFontFamily(element) {
        return window.getComputedStyle(element, null).getPropertyValue('font-family');
    }

    //endregion HELPERS
    //##########
    //region USAGE
    domFitFontSize();
    let timer = 0;
    window.addEventListener("resize", function () {
        clearTimeout(timer);
        timer = setTimeout(domFitFontSize, 200);
    });
    //endregion USAGE
    //##########
})();