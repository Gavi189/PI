"use client";

import { useEffect, useState } from "react";
import Image from "next/image";
import { useParams } from "next/navigation";
import { IProduct } from "@/interfaces/IProduct";
import { fetchProducts } from "@/services/product/get";
import { addToCart } from "@/services/cart/post";

const PageProduct = () => {
  const params = useParams();
  const { id } = params || {};
  const [product, setProduct] = useState<IProduct | null>(null);
  const [quantity, setQuantity] = useState(1);
  const [error, setError] = useState<string | null>(null);
  const id_cliente = 3; // Hardcoded for testing; replace with dynamic client ID from auth

  useEffect(() => {
    const loadProduct = async () => {
      try {
        const products = await fetchProducts();
        const foundProduct = products.find(
          (p) => Number(p.id_produto) === Number(id)
        );
        setProduct(foundProduct || null);
      } catch (err) {
        setError("Erro ao carregar o produto.");
        console.error(err);
      }
    };
    loadProduct();
  }, [id]);

  const handleAddToCart = async () => {
    if (product) {
      const success = await addToCart(product, id_cliente, quantity);
      if (success) {
        alert("Produto adicionado ao carrinho!");
      } else {
        setError(
          "Falha ao adicionar o produto ao carrinho. Verifique o console para detalhes."
        );
      }
    }
  };

  if (error) {
    return <p>{error}</p>;
  }

  if (!product) {
    return <p>Carregando...</p>;
  }

  return (
    <section className="w-full max-w-screen-xl mx-auto px-4">
      <div className="flex gap-4">
        <div className="relative h-100 w-100">
          <Image
            src={`http://localhost:8081/produtos/imagens/${
              product.imagem || "default.jpg"
            }`}
            alt={product.produto}
            fill
            sizes="100%"
            className="object-cover border border-gray-300"
            onError={(e) => {
              (e.target as HTMLImageElement).src = "/placeholder.jpg"; // Fallback image
            }}
          />
        </div>
        <div className="flex-1">
          <h1>{product.produto}</h1>
          <p>{product.marca || "Sem marca"}</p>
          <p>{product.descricao || "Sem descrição"}</p>
          <span>R$ {product.preco || "0,00"}</span>
          <div className="flex gap-2 py-4">
            <button
              onClick={() => setQuantity((q) => (q > 1 ? q - 1 : 1))}
              className="border border-gray-300 px-2"
            >
              -
            </button>
            <span>{quantity}</span>
            <button
              onClick={() => setQuantity((q) => q + 1)}
              className="border border-gray-300 px-2"
            >
              +
            </button>
          </div>
          <button
            onClick={handleAddToCart}
            className="border border-gray-300 px-4 py-2 bg-blue-500 text-white hover:bg-blue-600"
          >
            Adicionar ao Carrinho
          </button>
          {error && <p className="text-red-500 mt-2">{error}</p>}
        </div>
      </div>
    </section>
  );
};

export default PageProduct;
