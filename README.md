# Sistema de Gestão de Produtos Químicos

## Resumo
O projeto busca centralizar e profissionalizar o controle de reagentes e substâncias químicas em ambientes laboratoriais ou industriais. O sistema permite a gestão rigorosa de inventário, o controle de armazenamento em múltiplos depósitos e, principalmente, um fluxo de aprovação que garante o controle de segurança aos utilizadores e ao meio ambiente, orientado completamente pela [Ficha de Dados de Segurança](https://tailwindcss.com). O sistema utiliza uma interface limpa e intuitiva, inspirada em dashboards modernos, garantindo que usuários com diferentes níveis de permissão possam operar de forma eficiente e segura.

---

## 1. Funcionalidades Implementadas
* **Gestão de Acessos:** Sistema de permissões baseado em funções (**Solicitante, Avaliador e Administrador/ADM**).
* **Controle de Depósitos:** Criação e monitoramento de locais de armazenamento com indicadores visuais de ocupação.
* **Inventário Detalhado:** Registro de produtos vinculados a depósitos específicos, com campos para controle de validade e quantidade.
* **Gestão de Documentação (FDS):** Download do resumo da Fichas de Dados de Segurança vinculada a cada reagente.
* **Fluxo de Solicitação:** Sistema para solicitar a avaliação de novos produtos ou entradas de estoque.
* **Segurança e Auditoria:** Rastreamento de "Último Acesso" e controle de status de usuários (Ativo/Inativo).



---

## 2. Funcionalidades Previstas e Não Implementadas
* **Relatórios em PDF:** Exportação automática de relatórios de inventário e logs de movimentação.
* **Layout Lateral (Sidebar):** Embora previsto no protótipo inicial, optou-se por manter o menu superior para preservar a integridade visual e a fluidez de navegação sem a necessidade de refatoração estrutural profunda.

---

## 3. Outras Funcionalidades Implementadas
* **Interface Customizada:** Implementação de identidade visual própria utilizando o azul padrão (`#2563EB`) e ícones vetoriais customizados (SVG) para o setor químico.
* **Feedback ao Usuário:** Implementação de *Flash Messages* e blocos de erro para validação de formulários (como a confirmação de senha no cadastro de usuários).

---

## 4. Principais Desafios e Dificuldades
* **Arquitetura MVC:** Organizar a lógica de negócios para que o Admin pudesse gerenciar usuários sem ser deslogado (separando o fluxo de "Auto-registro" do fluxo de "Gestão Administrativa").
* **Consistência de UI/UX:** Transpor o design idealizado no Figma para o Tailwind CSS, garantindo que os formulários de adição de usuários seguissem o mesmo padrão visual dos formulários de depósito.
* **Customização do Laravel Breeze:** Adaptar o sistema de autenticação padrão para suportar campos administrativos extras (`role`, `department`, `job_title`).

---

## 5. Instruções para Instalação e Execução

### Pré-requisitos
* **Docker** e **Docker Compose** instalados.
* **PHP 8.2+** e **Composer**.

### Passo a Passo
1.  **Clonar o repositório:**
    ```bash
    git clone [https://github.com/seu-usuario/seu-repositorio.git](https://github.com/seu-usuario/seu-repositorio.git)
    cd seu-repositorio
    ```
2.  **Configurar o ambiente:**
    ```bash
    cp .env.example .env
    # Ajustar variáveis de banco de dados (DB_HOST=mysql, etc.)
    ```
3.  **Subir os contêineres:**
    ```bash
    ./vendor/bin/sail up -d
    ```
4.  **Instalar dependências e gerar chaves:**
    ```bash
    sail composer install
    sail npm install && sail npm run build
    sail artisan key:generate
    ```
5.  **Executar Migrations:**
    ```bash
    sail artisan migrate
    ```

---

## 6. Referências
* **Laravel Documentation:** [laravel.com/docs](https://laravel.com/docs)
* **Tailwind CSS:** [tailwindcss.com](https://tailwindcss.com)
* **Lucide Icons:** [lucide.dev](https://lucide.dev)
* **Docker Sail:** [laravel.com/docs/sail](https://laravel.com/docs/sail)