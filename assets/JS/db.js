const API_URL = "/assets/database/db.json";
const fetchApi = async (type = "collection", slug, collectionSlug = null) => {
    const allData = await fetch(API_URL).then((res) => {
        return res.json();
    });
    console.log(allData);
    if (type == 'all') {
        // Return all data
        return allData;
    } else if (type == 'collection') {
        // Return all data
        return allData.find(function(collection) {
            return collection.collection_slug == slug
        });
    } else if (type == 'product') {
        // Return all data
        let collection = allData.find(function(collection) {
            return collection.collection_slug == collectionSlug
        }); 
        return collection.products.find(function(product) {
            return product.slug == slug
        });
    } {
        // Return collection data
    }
}

const loadCollectionData = async (type="all", slug = null, collectionSlug = null) => {
    return await fetchApi(type, slug, collectionSlug);
}