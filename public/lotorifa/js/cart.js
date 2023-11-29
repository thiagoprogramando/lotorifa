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

            Swal.fire({
                title: 'Adicionar número ao carrinho?',
                text: `Adicionar o número ${number} ao carrinho?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Sim',
                cancelButtonText: 'Não'
            }).then((result) => {
                if (result.isConfirmed) {
                    
                    var existingNumbers = JSON.parse(localStorage.getItem('carrinho')) || [];
                    var numberInCart = existingNumbers.find(function (item) {
                        return item.gameId === gameId && item.numberId === numberId;
                    });

                    if (numberInCart) {
                        Swal.fire('Erro', 'Você já adicionou este número ao carrinho para este jogo!', 'error');
                    } else {

                        var numbersForGame = existingNumbers.filter(function (item) {
                            return item.gameId === gameId;
                        });

                        if (numbersForGame.length > 50) {
                            Swal.fire('Erro', 'Você atingiu o limite máximo de números para este jogo!', 'error');
                        } else {
                            
                            existingNumbers.push({
                                gameId: gameId,
                                gameName: gameName,
                                numberId: numberId,
                                numberValue: numberValue,
                                number: number
                            });

                            $(`[data-number-id="${numberId}"]`).removeClass('dis');
                            $(`[data-number-id="${numberId}"]`).addClass('ind');

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

function endCart() {
    
    var existingNumbers = JSON.parse(localStorage.getItem('carrinho')) || [];

    var numbersByGameId = {};
    existingNumbers.forEach(function (item) {
        if (!numbersByGameId[item.gameId]) {
            numbersByGameId[item.gameId] = [];
        }
        numbersByGameId[item.gameId].push(item);
    });

    var invalidGames = Object.keys(numbersByGameId).filter(function (gameId) {
        return numbersByGameId[gameId].length < 5;
    });

    if (invalidGames.length > 0) {
        var invalidGameNames = invalidGames.map(function (gameId) {
            return numbersByGameId[gameId][0].gameName;
        });
        Swal.fire('Erro', 'Sua aposta deve conter no mínimo 5 números. Verifique os jogo(s): ' + invalidGameNames.join(', '), 'error');
        return;
    }

    if (existingNumbers.length === 0) {
        Swal.fire('Erro', 'Seu carrinho está vazio. Adicione números antes de finalizar.', 'error');
        return;
    }

    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: '/endcart',
        type: 'POST',
        data: {
            _token: csrfToken,
            numbers: existingNumbers
        },
        success: function(response) {
            localStorage.removeItem('carrinho');
            updateCartModal();

            if(response.encodedImage) {

                Swal.fire({
                    title: 'Aprovado!',
                    text: 'Finalize o pagamento para ter seus números!',
                    icon: 'success',
                    imageUrl: 'data:image/png;base64,' + response.encodedImage,
                    imageAlt: 'QR Code',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Copiar Pix',
                }).then((result) => {
                    if (result.isConfirmed) {
                        
                        const input = document.createElement('textarea');
                        input.value = response.payload;
                        document.body.appendChild(input);
                        input.select();
                        document.execCommand('copy');
                        document.body.removeChild(input);

                        Swal.fire('Copiado!', 'O Pix copiado!', 'success');
                    }
                });
            } else {
                Swal.fire({

                    title: 'Aprovado!',
                    text: 'Iremos te redirecionar para a página de pagamento!',
                    icon: 'success',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ir para pagamento',
                }).then((result) => {
                    if (result.isConfirmed) {
                        
                        window.location.href = response.link;
                    }
                });
            }
        },
        error: function(error) {
            if (error.responseJSON && error.responseJSON.error) {
                Swal.fire('Atenção', error.responseJSON.error, 'warning');

                var invalidNumbers = error.responseJSON.invalidNumbers || [];
                var existingNumbers = JSON.parse(localStorage.getItem('carrinho')) || [];
                var updatedNumbers = existingNumbers.filter(function(item) {
                    return !invalidNumbers.includes(item.numberId);
                });
                localStorage.setItem('carrinho', JSON.stringify(updatedNumbers));

                updateCartModal();
            } else {
                Swal.fire('Erro', error.responseText, 'error');
            }
        }
    });
}

function loginCart() {
    Swal.fire({
        title: 'Atenção',
        text: 'Faça login para finalizar sua aposta!',
        icon: 'warning',
        confirmButtonText: 'OK'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '/acesso';
        }
    });
}