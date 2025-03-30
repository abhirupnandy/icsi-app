import './bootstrap';
import './navbar';

function showNotification(title, message) {
    if (Notification.permission === "granted") {
        new Notification(title, {
            body: message,
            icon: "/images/notify-icon.png"
        });
    } else if (Notification.permission !== "denied") {
        Notification.requestPermission().then(permission => {
            if (permission === "granted") {
                new Notification(title, {
                    body: message,
                    icon: "/images/notify-icon.png"
                });
            }
        });
    }
}

// Display session-stored notification for guests
document.addEventListener("DOMContentLoaded", function () {
    let notification = window.sessionStorage.getItem('contact_notification');
    if (notification) {
        notification = JSON.parse(notification);
        showNotification(notification.title, notification.message);
        window.sessionStorage.removeItem('contact_notification');
    }
});
