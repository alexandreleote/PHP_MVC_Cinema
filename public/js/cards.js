/* Initialisation des cartes */
export function initializeCards() {
    const cards = document.querySelectorAll('.list-card');
    cards.forEach(card => {
        const backgroundUrl = card.dataset.background;
        if (backgroundUrl) {
            card.style.backgroundImage = `url('${backgroundUrl}')`;
        }
    });
}
