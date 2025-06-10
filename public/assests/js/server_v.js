
export async function checkFieldExists(field, value, errorElementId) {
    try {
        const response = await fetch("index.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
                "X-Requested-With": "XMLHttpRequest"
            },
            body: `action=check_${field}&${field}=${encodeURIComponent(value)}`
        });

        if (!response.ok) throw new Error("Network response was not ok");

        const data = await response.text();
        if (data.trim() === "taken") {
            showError(errorElementId, `${field.charAt(0).toUpperCase() + field.slice(1)} already exists.`);
            return true;
        }
    } catch (error) {
        console.error(`Error checking ${field}:`, error);
        showError(errorElementId, `Error checking ${field} availability.`);
        return true;
    }
    return false;
}

    function showError(fieldId, message) {
        const errorElement = document.getElementById(fieldId);
        if (errorElement) {
            errorElement.textContent = message;
            errorElement.style.display = "block";
            errorElement.style.color = "red";
            errorElement.style.fontSize = "0.9em";
            errorElement.style.marginTop = "5px";
        } else {
            console.error(`Error element with ID ${fieldId} not found`);
        }
    }
 
    

