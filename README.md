# 🐳 Docker: Utilização Prática no Cenário de Microsserviços

> Projeto baseado no desafio da [DIO](https://dio.me) — com melhorias de segurança, portabilidade e boas práticas.

---

## Arquitetura

```
         ┌─────────────┐
 Usuário │  Nginx :4500 │  ← Load Balancer
         └──────┬───────┘
        ┌───────┼───────┐
        ▼       ▼       ▼
    [app1]  [app2]  [app3]   ← PHP 8.1 + Apache
        └───────┬───────┘
                ▼
          [ MySQL 8.0 ]       ← Banco de Dados
```

- **Nginx** distribui as requisições entre 3 instâncias PHP (Round Robin)
- Cada instância **registra seu hostname** no banco, provando qual container respondeu
- **MySQL** persiste os dados via Docker Volume

---

## Como executar localmente

### Pré-requisitos
- Docker
- Docker Compose

### Passo a passo

```bash
# 1. Clone o repositório
git clone https://github.com/Keila-Moloni-Stefani/Docker.git
cd Docker

# 2. Configure as variáveis de ambiente
cp .env.example .env
Edite o .env com suas senhas

# 3. Suba todos os containers
docker-compose up -d --build

# 4. Acesse no navegador
http://localhost:4500
```

Atualize a página várias vezes e veja o campo **Container (Host)** mudar — isso demonstra o load balancer em ação!

---

## Estrutura do Projeto

```
.
├── Dockerfile          # Imagem PHP 8.1 + Apache
├── Dockerfile.nginx    # Imagem Nginx (Load Balancer)
├── docker-compose.yml  # Orquestração dos serviços
├── nginx.conf          # Configuração do Load Balancer
├── index.php           # Aplicação PHP
├── banco.sql           # Script de criação do banco
├── .env.example        # Modelo de variáveis de ambiente
└── README.md
```

---

## Melhorias aplicadas vs projeto original

| Item | Original | Melhorado |
|---|---|---|
| Credenciais do banco | Hardcoded no código | Variáveis de ambiente (.env) |
| IPs no nginx.conf | IPs fixos da AWS | Nomes dos serviços Docker |
| Dockerfile | Só Nginx | PHP + Apache separado |
| SQL Injection | Query concatenada | Prepared Statements |
| Docker Compose | Não existia | Orquestração completa |
| Healthcheck no MySQL | Não existia | ✅ Adicionado |
| Volume de dados | Não existia | ✅ Persistência garantida |

---

## Tecnologias

![Docker](https://img.shields.io/badge/Docker-2496ED?style=flat&logo=docker&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=flat&logo=php&logoColor=white)
![Nginx](https://img.shields.io/badge/Nginx-009639?style=flat&logo=nginx&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=flat&logo=mysql&logoColor=white)

---

## Referências

- [Repositório original — Denilson Bonatti](https://github.com/denilsonbonatti/toshiro-shibakita)
- [DIO — Digital Innovation One](https://dio.me)

---

## Desenvolvedor

Desenvolvido por Keila Moloni Stefani

---

⭐ Se este projeto foi útil para você, considere dar uma estrela!
