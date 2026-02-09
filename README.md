# CSI606-2025-02 - Proposta de Trabalho Final

**Discente:** Márcio Paiva 23.1.8012

## Resumo

O **Sistema de Gerenciamento de Produtos Químicos (SGPC)** é um software essencial para o controle eficiente e seguro de substâncias químicas em ambientes corporativos e industriais. O projeto visa centralizar o controle sobre o **uso, armazenamento e inventário** de químicos, garantindo a **conformidade regulatória** e a **segurança operacional**. O Escopo Mínimo Viável (MVP) concentra-se em estabelecer o fluxo de trabalho crucial: gestão de acesso por perfis (Solicitante, Avaliador e Administrador), o processo de **solicitação e avaliação** de novos produtos, e a base do controle de **inventário** e **depósitos**.

---

## 1. Tema

O trabalho final tem como tema o desenvolvimento de um **Sistema de Gerenciamento de Produtos Químicos (SGPC)**.

## 2. Escopo (MVP)

Este projeto terá as seguintes funcionalidades como foco para o Mínimo Produto Viável (MVP):

### A. Gestão de Acesso e Usuários
* **Login e Autenticação:** Sistema de acesso seguro para usuários.
* **Perfis de Acesso:** Implementação dos perfis **Solicitante**, **Avaliador** (Técnico Especializado) e **Administrador**, com permissões e visualizações distintas.

### B. Gestão de Produtos e Inventário
* **Cadastro Detalhado de Produtos Químicos:** Registro de informações básicas de identificação e segurança de cada substância.
* **Cadastro de Depósitos/Áreas de Armazenamento:** Mapeamento das localizações físicas dos produtos.
* **Controle de Inventário:** Funcionalidade para rastrear a localização exata, a quantidade atual (entrada/saída) e o status de cada produto químico.

### C. Fluxo de Trabalho de Produtos
* **Solicitação de Avaliação:** Módulo para que o usuário Solicitante inicie o pedido de inclusão ou uso de um novo produto químico.
* **Avaliação de Produtos:** Módulo para o Avaliador analisar a solicitação, registrando parecer técnico (aprovação/reprovação) com base em critérios de segurança e regulamentação (esta funcionalidade é a base para garantir a conformidade).

## 3. Restrições

Neste trabalho, não serão considerados, no escopo do MVP:
* **Módulo de Segurança e Saúde Avançado:** Alertas em tempo real sobre incompatibilidade química ou a gestão detalhada de Equipamentos de Proteção Individual (EPIs) necessários para o manuseio.
* **Integração com Sistemas Externos:** Não será realizada integração com APIs regulatórias externas (ex: consulta automática de FISPQ de fornecedores) ou sistemas de gestão empresarial (ERP).
* **Geração de Relatórios Complexos:** O foco inicial será no cadastro e no fluxo de trabalho. Relatórios de conformidade e uso histórico complexos serão considerados em fases futuras.
* **Desenvolvimento de Módulos Secundários:** A área de FDS (FISPQ) no menu será implementada inicialmente apenas para consulta e cadastro manual básico, sem funcionalidades avançadas de indexação ou pesquisa.

## 4. Protótipo

Protótipos para as páginas essenciais do SGPC foram elaborados, abrangendo as áreas críticas do sistema. O protótipo visualiza as seguintes telas principais:

1.  **Tela de Login.**
2.  **Dashboard (Início).**
3.  **Fluxo de Solicitação e Avaliação** (Telas: Solicitar Avaliação e Avaliar).
4.  **Gestão de Infraestrutura** (Telas: Depósitos e Inventário).
5.  **Gestão de Acesso** (Tela: Acessos).

O protótipo completo, incluindo o menu de navegação lateral (conforme imagem anexada), pode ser encontrado em:

**Link do Figma:**
[https://www.figma.com/community/file/1572984026426734050](https://www.figma.com/community/file/1572984026426734050)

## 5. Referências

-