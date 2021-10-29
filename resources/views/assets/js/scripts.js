$.ajaxSetup({
    headers:{
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

const BASE = $('meta[name="BASE"]').attr('content');

$('body').on('click','.excluirUsuario',function(e){
    e.preventDefault()
    excluirUsuario($(this).attr('href'), 'DELETE','Deseja realmente excluir este usuário?')
})

$('body').on('click','.excluirUsuarioPermanentemente',function(e){
    e.preventDefault()
    excluirUsuario($(this).attr('href'), 'POST','Deseja realmente excluir permanentemente este usuário?')
})

function excluirUsuario(link, method, msg){
    const confirma = confirm(msg)

    if(confirma){        
        $.ajax({
            url: link,
            method: method,
            success: function(r){
                if(r.status){
                    alert('Usuário excluído com sucesso!')
                }
                window.location.reload()
            }
        })
    }
}

$('body').on('submit', 'form[name="formUsuario"]', function(e){
    $('button[type="submit"]').attr('disabled', true)
    e.preventDefault()
    $(this).ajaxSubmit({
        url:$(this).attr('action'),
        dataType:'json',
        method:'post',
        error:function(r){
            const erros = r.responseJSON
            if (erros) {
                for (const erro in erros.errors) {
                    alert(erros.errors[erro][0])
                }
            }
            $('button[type="submit"]').attr('disabled', false)
        },
        success:function(r){
            if(r.status == true){
                alert('Dados salvos com sucesso!')

                if(r.url){
                    window.location.href = r.url
                }else{
                    window.location.reload()
                }
            }else{
                alert(r.msg)
            }
            $('button[type="submit"]').attr('disabled', false)
        }
    })

})

$('body').on('submit', 'form[name="formVeiculo"]', function(e){
    e.preventDefault()
    $('button[type="submit"]').attr('disabled', true)

    $(this).ajaxSubmit({
        url:$(this).attr('action'),
        dataType:'json',
        method:'post',
        error:function(r){
            const erros = r.responseJSON
            if (erros) {
                for (const erro in erros.errors) {
                    alert(erros.errors[erro][0])
                }
            }
            $('button[type="submit"]').attr('disabled', false)
        },
        success:function(r){
            if(r.status){
                alert('Dados salvos com sucesso!')
                
                if(r.url){
                    window.location.href = r.url
                }else{
                    window.location.reload()
                }
            }else{
                alert(r.msg)
            }
            $('button[type="submit"]').attr('disabled', false)
        }
    })

})

$('body').on('click','.excluirVeiculo',function(e){
    e.preventDefault()
    const confirma = confirm('Deseja realmente excluir este veículo?')

    if(confirma){        
        $.ajax({
            url: $(this).attr('href'),
            method: 'DELETE',
            success: function(r){
                if(r.status){
                    alert('Veículo excluído com sucesso!')
                }

                window.location.reload()
            }
        })
    }
})

if($('.gallery').length){
    $('.gallery').lightGallery({
        thumbnail: true,
        selector: '.imagem'
    })
}