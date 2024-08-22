console.log("customizer should load now!");
function getLocationIdFromUrl(url) {
    const match = url.match(/location\/([^/]+)/);
    return match ? match[1] : null;
}
let locurl = location.href;

const locationId = getLocationIdFromUrl(locurl);
const endpoint = "https://lightblue-mouse-661506.hostingersite.com/api/dashboard-style/" + locationId; 

// Function to fetch the CSS and append it to the head
async function fetchAndApplyCSS(url) {
    console.log(url)
    try {
        // Fetch the CSS from the provided URL
        const response = await fetch(url, {
            headers: {
                'Accept': 'text/css'
            }
        });

        // Check if the response status is 200
        if (response.status === 200) {
            const cssContent = await response.text();

            // Create a style element
            const styleElement = document.createElement("style");

            // Set the inner text to the fetched CSS
            styleElement.textContent = cssContent;

            // Append the style element to the head
            document.head.appendChild(styleElement);

            console.log("CSS applied successfully.");
        } else {
            console.log("Failed to fetch CSS, status code:", response.status);
        }
    } catch (error) {
        console.error("Error fetching and applying CSS:", error);
    }
}

// URL to fetch CSS from


// Fetch and apply the CSS
fetchAndApplyCSS(endpoint);