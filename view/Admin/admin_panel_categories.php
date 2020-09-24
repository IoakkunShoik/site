<style>
    .sec_panel{
        margin-top: -100vw;
        position: absolute;
        
    }
    .unhide:active .sec_panel{
        margin-top:-1vw;
        display: block;
    }
    .sec_panel:hover{
        margin-top:-1vw;
        display: block;
    }
</style>
<div class="unhide"><button>ADD CATEGORY</button>
    <div class="sec_panel">
        <form method='post'>
            <input type="text" name="name" placeholder='name' autocomplete="off"> <br>
            <textarea name="ids" placeholder='ids'></textarea>
            <input type="submit" value='добавить категорию'>
        </form>
    </div>
</div> <br>

<div class="content" style='display: block'>
    <table>
        $$$CONTENT$$$
    </table>
</div>