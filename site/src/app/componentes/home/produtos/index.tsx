"use client";
import { useEffect, useState } from "react";

export function ProdutosHome() {
  interface Produto {
    id_produto: number;
    produto: string;
    descricao: string;
    imagem: string;
    preco: number;
    marca: string;
  }

  //useState para armazenar os produtos
  const [produtos, setProdutos] = useState<Produto[]>([]);

  //useEffect para buscar os produtos quando o componente for montado
  useEffect(() => {
    const fetchProdutos = async () => {
      try {
        const request = await fetch("http://localhost:8080/produtos", {
          method: "GET",
          headers: {
            "Content-Type": "application/json",
          },
        });
        const result = await request.json();
        if (Array.isArray(result.data)) {
          setProdutos(result.data);
        } else {
          setProdutos([]);
        }
      } catch (error) {
        console.error("Erro ao buscar produtos:", error);
        setProdutos([]);
      }
    };

    fetchProdutos();
  }, []);

  // Simulação de post a uma API ou banco de dados
  const adicionarAoCarrinho = async (
    produtoId: number,
    nomeProduto: string
  ) => {
    try {
      // Ajuste o endpoint e o corpo conforme a API do carrinho
      const response = await fetch("http://localhost:8080/produtos/", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({
          id_marca: produtoId,
          produto: nomeProduto,
        }),
      });

      if (!response.ok) {
        throw new Error("Failed to add product to cart");
      }

      const data = await response.json();
      console.log("Product added to cart:", data);
    } catch (error) {
      console.error("Failed to add product to cart:", error);
    }
  };

  return (
    <section className="w-full bg-gray-200 flex flex-col items-center justify-center py-10">
      <h2 className="text-5xl font-bold text-gray-800 mb-6">Produtos</h2>
      <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 w-full max-w-screen-xl px-4">
        {/* Exemplo de produto */}

        {Array.isArray(produtos) &&
          produtos.map((produto: Produto, index: number) => (
            <div
              key={index}
              className="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300"
            >
              <img
                src={`http://localhost:8081/produtos/imagens/${produto.imagem}`}
                alt={produto.produto}
                className="w-full h-48 object-cover rounded-t-lg mb-4"
              />
              <h3 className="text-xl font-semibold text-gray-800">
                {produto.produto}
              </h3>
              <p className="text-gray-600 mt-2">{produto.descricao}</p>
              <span className="text-lg font-bold text-green-600 mt-2">
                {produto.preco}
              </span>
            </div>
          ))}
        {/* Adicione mais produtos conforme necessário */}
      </div>
      <button
        onClick={() => {
          if (produtos.length > 0) {
            adicionarAoCarrinho(produtos[1].id_produto, produtos[1].produto);
          }
        }} // Exemplo: adiciona o primeiro produto ao carrinho
        className="mt-6 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-300"
      >
        Adicionar
      </button>
    </section>
  );
}
