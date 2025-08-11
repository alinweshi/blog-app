import Echo from "laravel-echo";

import Pusher from "pusher-js";
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: "pusher",
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: true,
    wsHost: import.meta.env.VITE_PUSHER_HOST,
    wsPort: import.meta.env.VITE_PUSHER_PORT,
    wssPort: import.meta.env.VITE_PUSHER_PORT,
    enabledTransports: ["ws", "wss"],
});
window.Echo.private("admin-notifications").listen("PostCreated", (e) => {
    console.log("New post created event received:", e);
    const notifCountElem = document.getElementById("notif-count");
    const notifHeader = document.getElementById("notif-header");
    const notifItems = document.getElementById("notif-items");

    // Update count
    let count = parseInt(notifCountElem.innerText) || 0;
    count++;
    notifCountElem.innerText = count;

    // Update header text
    notifHeader.innerText = `${count} Notifications`;

    // Add new notification item
    notifItems.insertAdjacentHTML(
        "afterbegin",
        `
            <div class="dropdown-divider"></div>
            <a href="/admin/posts/${e.post.id}" class="dropdown-item">
                <i class="bi bi-file-earmark-fill me-2"></i> New post: <strong>${
                    e.post.title
                }</strong>
                <span class="float-end text-secondary fs-7">${new Date().toLocaleTimeString()}</span>
            </a>
        `
    );
});
