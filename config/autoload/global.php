<?php

/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */
return array(
    // ...

    'acl' => array(
        'roles' => array(
            'VISITANTE' => null,
            'ADMIN' => 'VISITANTE',
        ),
        'resources' => array(
            'Application\Controller\Index.index',
            'Application\Controller\Index.opcoes',
            'Application\Controller\Index.pagina',
            'Application\Controller\Login.login',
            'Application\Controller\Login.logout',
            'Application\Controller\Usuarios.index',
            'Application\Controller\Usuarios.save',
            'Application\Controller\Usuarios.delete',
            'Application\Controller\Perfis.index',
            'Application\Controller\Perfis.save',
            'Application\Controller\Perfis.delete',
            'Application\Controller\Murais.index',
            'Application\Controller\Murais.save',
            'Application\Controller\Murais.delete',
            'Application\Controller\Comentarios.index',
            'Application\Controller\Comentarios.save',
            'Application\Controller\Comentarios.delete',
            'Application\Controller\Likes.index',
            'Application\Controller\Likes.save',
            'Application\Controller\Likes.delete',
            'Application\Controller\Deslikes.index',
            'Application\Controller\Deslikes.save',
            'Application\Controller\Deslikes.delete',
            'Application\Controller\Imagens.index',
            'Application\Controller\Imagens.save',
            'Application\Controller\Imagens.delete',
            'Application\Controller\Deslikes.delete',
            'Application\Controller\Albuns.index',
            'Application\Controller\Albuns.save',
            'Application\Controller\Albuns.delete',
            'Application\Controller\Cidades.index',
            'Application\Controller\Cidades.save',
            'Application\Controller\Cidades.delete',
            'Application\Controller\Enderecos.index',
            'Application\Controller\Enderecos.save',
            'Application\Controller\Enderecos.delete',
            'Application\Controller\Eventos.index',
            'Application\Controller\Eventos.save',
            'Application\Controller\Eventos.delete',
            'Application\Controller\MuralEventos.index',
            'Application\Controller\MuralEventos.save',
            'Application\Controller\MuralEventos.delete',
            'Application\Controller\ParticipantesEventos.index',
            'Application\Controller\ParticipantesEventos.save',
            'Application\Controller\ParticipantesEventos.delete',
            'Application\Controller\Ufs.index',
            'Application\Controller\Ufs.save',
            'Application\Controller\Ufs.delete',
            'Application\Controller\Usuarios.index',
            'Application\Controller\Usuarios.save',
            'Application\Controller\Usuarios.delete',
        ),
        'privilege' => array(
            'VISITANTE' => array(
                'allow' => array(
                    'Application\Controller\Login.login',
                    'Application\Controller\Login.logout'
                )
            ),
            'ADMIN' => array(
                'allow' => array(
                    'Application\Controller\Index.index',
                    'Application\Controller\Index.opcoes',
                    'Application\Controller\Index.pagina',
                    'Application\Controller\Usuarios.index',
                    'Application\Controller\Usuarios.save',
                    'Application\Controller\Usuarios.delete',
                    'Application\Controller\Perfis.index',
                    'Application\Controller\Perfis.save',
                    'Application\Controller\Perfis.delete',
                    'Application\Controller\Murais.index',
                    'Application\Controller\Murais.save',
                    'Application\Controller\Murais.delete',
                    'Application\Controller\Comentarios.index',
                    'Application\Controller\Comentarios.save',
                    'Application\Controller\Comentarios.delete',
                    'Application\Controller\Likes.index',
                    'Application\Controller\Likes.save',
                    'Application\Controller\Likes.delete',
                    'Application\Controller\Deslikes.index',
                    'Application\Controller\Deslikes.save',
                    'Application\Controller\Deslikes.delete',
                    'Application\Controller\Imagens.index',
                    'Application\Controller\Imagens.save',
                    'Application\Controller\Imagens.delete',
                    'Application\Controller\Deslikes.delete',
                    'Application\Controller\Albuns.index',
                    'Application\Controller\Albuns.save',
                    'Application\Controller\Albuns.delete',
                    'Application\Controller\Cidades.index',
                    'Application\Controller\Cidades.save',
                    'Application\Controller\Cidades.delete',
                    'Application\Controller\Enderecos.index',
                    'Application\Controller\Enderecos.save',
                    'Application\Controller\Enderecos.delete',
                    'Application\Controller\Eventos.index',
                    'Application\Controller\Eventos.save',
                    'Application\Controller\Eventos.delete',
                    'Application\Controller\MuralEventos.index',
                    'Application\Controller\MuralEventos.save',
                    'Application\Controller\MuralEventos.delete',
                    'Application\Controller\ParticipantesEventos.index',
                    'Application\Controller\ParticipantesEventos.save',
                    'Application\Controller\ParticipantesEventos.delete',
                    'Application\Controller\Ufs.index',
                    'Application\Controller\Ufs.save',
                    'Application\Controller\Ufs.delete',
                    'Application\Controller\Usuarios.index',
                    'Application\Controller\Usuarios.save',
                    'Application\Controller\Usuarios.delete',
                )
            ),
        )
    )
);
