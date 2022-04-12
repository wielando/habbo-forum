document.addEventListener("DOMContentLoaded", function (event) {

    const defaultTab = 'announcement';

    const announcementEntriesIdentifier = 'announcementEntries';
    const communityEntriesIdentifier = 'communityEntries';

    const announcementEntriesElement = document.querySelector('[data-tab=' + announcementEntriesIdentifier + ']')
    const communityEntriesElement = document.querySelector('[data-tab=' + communityEntriesIdentifier + ']')

    let currentTab = '';
    let currentTabEntryIdentifier = '';

    const forumTabs = document.querySelectorAll('.forum-tab');

    if (defaultTab === 'announcement') {
        document.querySelector('#announcementContent').style.display = "block";
    }

    if (defaultTab === 'community') {
        document.querySelector('#communityContent').style.display = "block";
    }

    for (const [key, tabElement] of Object.entries(forumTabs)) {
        tabElement.addEventListener('click', (element) => {
            currentTab = element.target.dataset.tabname;
            currentTabEntryIdentifier = currentTab + 'Entries';

            if (currentTabEntryIdentifier === announcementEntriesIdentifier) {
                announcementEntriesElement.style.display = "block";
                communityEntriesElement.style.display = "none";
            }

            if (currentTabEntryIdentifier === communityEntriesIdentifier) {
                announcementEntriesElement.style.display = "none";
                communityEntriesElement.style.display = "block";
            }

        });
    }

});