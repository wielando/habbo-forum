document.addEventListener("DOMContentLoaded", function (event) {

    const defaulTab = 'announcement';
    let currentTab = '';

    const forumTabs = document.querySelectorAll('.forum-tab');

    for (const [key, tabElement] of Object.entries(forumTabs)) {
        tabElement.addEventListener('click', (element) => {
            currentTab = element.target.dataset.tabname;
        });
    }

});