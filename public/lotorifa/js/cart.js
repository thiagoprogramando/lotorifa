$('#cartButton').click( function(){
    updateCartModal();
});

document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('li.dis').forEach(function (li) {
        li.addEventListener('click', function () {
            var numberId = li.getAttribute('data-number-id');
            var gameId = li.getAttribute('data-game-id');
            var gameName = li.getAttribute('data-game-name');
            var number = li.getAttribute('data-number');
            var numberValue = li.getAttribute('data-number-value');

            // Exibir o SweetAlert de confirmação
            Swal.fire({
                title: 'Adicionar número ao carrinho?',
                text: `Adicionar o número ${number} ao carrinho?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Sim',
                cancelButtonText: 'Não'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Verifique se já existe um carrinho local
                    var existingNumbers = JSON.parse(localStorage.getItem('carrinho')) || [];

                    // Verifique se o número já está no carrinho
                    var numberInCart = existingNumbers.find(function (item) {
                        return item.gameId === gameId && item.numberId === numberId;
                    });

                    if (numberInCart) {
                        Swal.fire('Erro', 'Você já adicionou este número ao carrinho para este jogo!', 'error');
                    } else {
                        // Verifique se já há 10 números para o jogo atual no carrinho
                        var numbersForGame = existingNumbers.filter(function (item) {
                            return item.gameId === gameId;
                        });

                        if (numbersForGame.length >= 10) {
                            Swal.fire('Erro', 'Você atingiu o limite máximo de números para este jogo!', 'error');
                        } else {
                            // Adicione o número ao carrinho
                            existingNumbers.push({
                                gameId: gameId,
                                gameName: gameName,
                                numberId: numberId,
                                numberValue: numberValue,
                                number: number
                            });

                            // Adicione a classe 'ind' ao li correspondente
                            $(`[data-number-id="${numberId}"]`).removeClass('dis');
                            $(`[data-number-id="${numberId}"]`).addClass('ind');

                            // Salve o carrinho localmente
                            localStorage.setItem('carrinho', JSON.stringify(existingNumbers));

                            Swal.fire('Sucesso', 'Número adicionado ao carrinho!', 'success');

                            updateCartModal();
                        }
                    }
                }
            });
        });
    });
});

$(document).ready(function() {
    updateCartModal();
});

function updateCartModal() {
    var existingNumbers = JSON.parse(localStorage.getItem('carrinho')) || [];
    var cartItemsContainer = $('#cartItems');
    cartItemsContainer.empty();

    existingNumbers.forEach(function(item, index) {
        var cartItem = $('<div class="item mb-3">' +
            '<div class="text">' +
            '<div class="number">' + item.number + '</div>' +
            '<div class="name">Concurso ' + item.gameName + '</div>' +
            '</div>' +
            '<i class="bi bi-trash icon-right delete-icon"></i>' +
            '</div>');

        cartItem.find('.delete-icon').click(function() {
            deleteItem(item.numberId, updateCartModal);
        });

        cartItemsContainer.append(cartItem);
    });
}

function deleteItem(numberId, callback) {

    var existingNumbers = JSON.parse(localStorage.getItem('carrinho')) || [];

    existingNumbers = existingNumbers.filter(function(item) {
        return item.numberId !== numberId;
    });

    localStorage.setItem('carrinho', JSON.stringify(existingNumbers));

    if (typeof callback === 'function') {
        callback();
    }
}

function clearCart() {
    localStorage.removeItem('carrinho');
    updateCartModal();
    location.reload();
}