<style>
    .form *{
    /*    background: transparent;*/
    }
    .scontent{
        display: block;
        background-color: gray;
        padding: 1vw;
        border-radius: 0vw 0vw 1vw 1vw;
        font-family: 'Philosopher', sans-serif;
    }
    table{
        flex-grow: 1;
        width: 100%;
    }
    td{
        padding: 0px;
        height: 2vw;
        font-size: 1vw;
    }
    .td{
        width: 60vw;
        text-overflow: ellipsis;
        overflow: hidden;
        white-space: nowrap;
    }
    .search,.filters,.cart{
        display: none;
    }

    .shop{
        display: block;
    }

</style>
<div class="scontent">
    <table><tbody>
        <tr><td>Фото</td><td>Описание</td><td>Цена</td><td>Количество</td></tr>
        $$$CONTENT$$$
        <tr><td>Итого:</td><td></td><td>$$$SUM$$$</td><td></td></tr>
    </tbody></table>
    <hr>
    <form action="">
        <table class='form'>
        <tr><td>Доставка</td></tr>

        <tr><td>Оплата</td></tr>
        <tr><td>Заказать</td></tr>
        </table>
    </form>
</div>