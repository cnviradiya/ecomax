const API_URL = "/assets/database/db.json";

const fetchApi = async (type = "collection", slug, collectionSlug = null) => {
    const allData = await fetch(API_URL).then((res) => {
        return res.json();
    });
    if (type == 'all') {
        // Return all data
        return allData;
        
    } else if (type == 'collection') {
        // Return all data
        return allData.find(function(collection) {
            return collection.collection_slug == slug
        });
    } else if (type == 'product'){
        // Return all data
        let collection = allData.find(function(collection) {
            return collection.collection_slug == collectionSlug
        });
        return collection.products.find(function(product) {
            return product.slug == slug
        });
    }
    return {};
}

const loadCollectionData = async (type="all", slug = null, collectionSlug = null) => {
    return await fetchApi(type, slug, collectionSlug);
}

const industrial_url = "/assets/industrial_Database/industrial_data.json";

const industrialdata = async (type = "industrial_collection", slug , collectionSlug = null ) => {
    const allindustrial = await fetch(industrial_url).then((res) => res.json());
    
    if (type == "allindustrial") {
        return allindustrial;
    } else if (type == "industrial_collection") {
        return allindustrial.find(function(collection) {
            return collection.collection_slug == slug;
        });
    }
};

const loadindustrialcollection = async (type = "all", slug = null, collectionSlug = null) => {
    return await industrialdata(type, slug, collectionSlug);
};

loadindustrialcollection("allindustrial").then(data => {
    console.log(data);
});