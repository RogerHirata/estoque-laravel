protected $fillable - é uma lista de segurança que define quais colunas do banco de dados podem ser preenchidas diretamente 
pelo usuário através de um formulário ou requisições HTTP.

exemplo: protected $fillable = ['nome', 'preco', 'category_id'];
Isso diz ao Laravel: "Apenas as colunas nome, preco e category_id podem ser gravadas em massa via $request->all()."

public function - No contexto das Models do Laravel, usamos public function para definir os relacionamentos entre as tabelas.
Ao criar essa função na Model Category, você poderá acessar os produtos de uma categoria no seu código simplesmente chamando $categoria->products.

HasMany ("Tem Muitos")
É o tipo de relacionamento usado quando um registro de uma tabela possui vários registros em outra tabela.

BelongsTo ("Pertence a")
É o inverso do HasMany. É usado na Model da tabela que guarda a chave estrangeira (foreign key) para indicar que aquele registro pertence a um registro pai de outra tabela.
