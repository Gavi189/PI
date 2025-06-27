//Adicionar um produto ao carrinho usando post
export const adicionarAoCarrinho = async (produtoId: number) => {
  try {
    const response = await fetch("http://localhost:8080/produtos", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ id_produto: produtoId }),
    });

    if (!response.ok) {
      throw new Error("Erro ao adicionar produto ao carrinho");
    }

    const data = await response.json();
    console.log("Produto adicionado ao carrinho:", data);
  } catch (error) {
    console.error("Erro ao adicionar produto ao carrinho:", error);
  }
};
