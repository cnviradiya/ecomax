const ASSET_URL = "https://ik.imagekit.io/ecomax/";

function getAssetURL(assetPath) {
    if (location.hostname === "localhost" || location.hostname === "127.0.0.1") {
        // set asset path locally
        return assetPath;
    } else {
        // set asset path globally
        return ASSET_URL + assetPath;
    }
}

function loadJS(jsArr) {
    jsArr.map(function (jsPath) {
        let scriptTag = document.createElement('script');
        scriptTag.setAttribute('src', getAssetURL(jsPath));
        document.body.appendChild(scriptTag);
    })
}

function loadJS1(jsArr) {
    jsArr.map(function (jsPath) {
        let scriptTag = document.createElement('script');
        scriptTag.setAttribute('src', getAssetURL(jsPath));
        document.body.appendChild(scriptTag);
    })
}